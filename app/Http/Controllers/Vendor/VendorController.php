<?php

namespace App\Http\Controllers\Vendor;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Notifications\VendorRegistration;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Notification;

class VendorController extends Controller
{
    public function index(){
        return view('vendor.index');
    }

    // Profile Date ----------------------------------------------
    public function profile(){
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('vendor.profile',compact('vendorData'));
    } //End Method

    // Profile Store Data ------------------------------------------------
    public function Store(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('media/profile/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('media/profile'),$fileName);
            $data['photo'] = $fileName;
        }
        $data->save();
        $notification=array(
            'message'=>' Vendor Profile Update Successfully',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    }//End Method

    // Password Change --------------------------------------
    public function ChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('vendor.body.passwordChange');
    } // End Method


    // Update Password -----------------------------------------
    public function ChangeStore(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'con_password' => 'required|min:8',
        ]);

        $db_pass = Auth::user()->password;
        $current_password = $request->old_password;
        $newPass = $request->new_password;
        $confirmPass = $request->con_password;

       if (Hash::check($current_password,$db_pass)) {
          if ($newPass === $confirmPass) {
            User::findOrFail(Auth::id())->update([
                'password' => Hash::make($newPass)
              ]);

              Auth::logout();
              $notification=array(
                'message'=>' Your Password Change Success. Now Login With New Password',
                'alert'=>'success'
            );
            return Redirect()->route('login')->with($notification);

          }else {

            $notification=array(
                'message'=>' New Password And Confirm Password Not Same',
                'alert'=>'success'
            );
            return Redirect()->back()->with($notification);
          }
       }else {
        $notification=array(
            'message'=>' Old Password Not Match',
                'alert'=>'error'
        );
        return Redirect()->back()->with($notification);
        }
    }// End Method



    //   ----------------------------- Vendor Login ------------------------------------------------

    public function BecomeVendorLogin(){
        return view('auth.vendor_login');
    }

    //   ----------------------------- Vendor Register ------------------------------------------------

    public function BecomeVendor(){
        return view('auth.become_vendor');
    }

    public function vendorCreate(Request $request){
        $user = User::where('role','admin')->get();

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'vendor_join' => Carbon::now(),
            'role' => 'vendor',
            'status' => 'inactive',
            'vendor_join' => Carbon::now(),
            'password' => Hash::make($request->password),

        ]);
        $notification=array(
            'message'=>'Vendor Register Successfully ',
            'alert'=>'success'
        );
        Notification::send($user, new VendorRegistration($request));
        return Redirect()->route('become.vendor.login')->with($notification);

    }// End Method



}
