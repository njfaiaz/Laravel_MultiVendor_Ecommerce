<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    // Profile Date ----------------------------------------------
    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile',compact('adminData'));
    } //End Method

    // Profile Store Data ------------------------------------------------
    public function Store(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;

        if ($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('admin/media/profile/'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('admin/media/profile'),$fileName);
            $data['photo'] = $fileName;
        }
        $data->save();
        $notification=array(
            'message'=>' Admin Profile Update Successfully',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    }//End Method

    // Password Change --------------------------------------
    public function ChangePassword(){
        $id = Auth::user()->id;
        $data = User::find($id);
        return view('admin.body.passwordChange');
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
}


