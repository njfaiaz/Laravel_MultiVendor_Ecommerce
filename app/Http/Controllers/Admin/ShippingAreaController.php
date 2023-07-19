<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipDistricts;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function index(){
        $division = ShipDivision::latest()->get();
        return view('admin.shipping.division.index',compact('division'));
    } // End Method

    public function add(){
        return view('admin.shipping.division.add');
    } // End Method

    public function Store(Request $request){

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Division Inserted Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('division')->with($notification);
    } // End Method

    public function Edit($id){
        $division = ShipDivision::findOrFail($id);
        return view('admin.shipping.division.edit',compact('division'));

    }// End Method

    public function Update(Request $request){
        $shipping_id = $request->id;

        ShipDivision::findOrFail($shipping_id)->Update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Division Updated Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('division')->with($notification);

    } // End Method

    public function Delete($id){
        ShipDivision::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Division Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method

    // -------------------------  District -------------------------------------------------------------------
    public function District(){
        $district = ShipDistricts::latest()->get();
        return view('admin.shipping.district.index',compact('district'));
    } // End Method

    public function addDistrict(){
        $division = ShipDivision::orderBy('division_name','ASC')->latest()->get();
        return view('admin.shipping.district.add',compact('division'));
    } // End Method


    public function StoreDistrict(Request $request){

        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'District Inserted Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('district')->with($notification);
    } // End Method


    public function EditDistrict($id){
        $division = ShipDivision::orderBy('division_name','ASC')->latest()->get();
        $district = ShipDistricts::findOrFail($id);
        return view('admin.shipping.district.edit',compact('division','district'));

    }// End Method

    public function UpdateDistrict(Request $request){
        $district_id = $request->id;

        ShipDistricts::findOrFail($district_id)->Update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'District Updated Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('district')->with($notification);

    } // End Method

    public function DeleteDistrict($id){
        ShipDistricts::findOrFail($id)->delete();

        $notification=array(
            'message'=>'District Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method



    // --------------------------------- State ----------------------------------------------------
    public function State(){
        $state = ShipState::latest()->get();
        return view('admin.shipping.state.index',compact('state'));
    } // End Method


    public function addState(){
        $division = ShipDivision::orderBy('division_name','ASC')->latest()->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->latest()->get();
        return view('admin.shipping.state.add',compact('division','district'));
    } // End Method


    public function GetDistrict($district_id){

        $district = ShipDistricts::where('division_id',$district_id)->orderBy('district_name','ASC')->get();
        return json_encode($district);

    } //End Method

    public function StoreState(Request $request){

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'State Inserted Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('state')->with($notification);
    } // End Method

    public function EditState($id){
        $division = ShipDivision::orderBy('division_name','ASC')->latest()->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->latest()->get();
        $state = ShipState::findOrFail($id);
        return view('admin.shipping.state.edit',compact('division','district','state'));
    } // End Method


    public function UpdateState(Request $request){
        $state_id = $request->id;

        ShipState::findOrFail($state_id)->Update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'State Updated Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('state')->with($notification);

    } // End Method

    public function DeleteState($id){
        ShipState::findOrFail($id)->delete();

        $notification=array(
            'message'=>'State Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method

}
