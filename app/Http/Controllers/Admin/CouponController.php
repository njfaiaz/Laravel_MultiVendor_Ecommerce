<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $coupon = Coupon::latest()->get();
        return view('admin.coupon.index',compact('coupon'));
    } // End Method


    public function add(){
        return view('admin.coupon.add');
    } // End Method



    public function Store(Request $request){

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Coupon Inserted Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('coupon')->with($notification);
    } // End Method


    public function Edit($id){
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit',compact('coupon'));

    }// End Method

    public function Update(Request $request){
        $coupon_id = $request->id;

        Coupon::findOrFail($coupon_id)->Update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Coupon Updated Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('coupon')->with($notification);

    } // End Method


    public function Delete($id){
        Coupon::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Coupon Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method


}
