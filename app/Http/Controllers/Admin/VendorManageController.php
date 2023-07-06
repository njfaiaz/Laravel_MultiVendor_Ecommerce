<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class VendorManageController extends Controller
{
    public function vendorInactive(){
        $inActiveVendor = User::where('status','inactive')->where('role_id','3')->latest()->get();
        return view('admin.vendorManage.inActive',compact('inActiveVendor'));
    } // End Method


    public function vendorActive(){
        $ActiveVendor = User::where('status','active')->where('role_id','3')->latest()->get();
        return view('admin.vendorManage.Active',compact('ActiveVendor'));
    } // End Method




    public function inActiveDetails($id){
        $inActiveVendorDetails = User::findOrFail($id);
        return view('admin.vendorManage.inactive_vendor_details',compact('inActiveVendorDetails'));
    }// End Method





    public function activeVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);
        $notification=array(
            'message'=>'Vendor Active Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('active.vendor')->with($notification);
    }// End Method




    public function ActiveDetails($id){
        $ActiveVendorDetails = User::findOrFail($id);
        return view('admin.vendorManage.active_vendor_details',compact('ActiveVendorDetails'));
    }// End Method


    public function inActiveVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);
        $notification=array(
            'message'=>'Vendor In Active Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('inactive.vendor')->with($notification);
    }// End Method

}
