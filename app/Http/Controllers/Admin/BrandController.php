<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::latest()->get();
        return view('admin.brand.index',compact('brands'));

    } // End Index Method

    public function add(){
        return view('admin.brand.add');

    }// End add Method

    public function Store(Request $request){
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('media/brand/'.$name_gen);
        $save_url = ('media/brand/'.$name_gen);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url,
        ]);
        $notification=array(
            'message'=>'Brand Image Uploaded Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('brand')->with($notification);

    }// End Method

    public function Edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit',compact('brand'));

    }// End Method

    public function Update(Request $request){
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('media/brand/'.$name_gen);
            $save_url = ('media/brand/'.$name_gen);

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Brand::findOrFail($brand_id)->Update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
                'brand_image' => $save_url,
            ]);
            $notification=array(
                'message'=>'Brand Updated With Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('brand')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->Update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            ]);
            $notification=array(
                'message'=>'Brand Updated Without Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('brand')->with($notification);
        }
    } // End Method

    public function Delete($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink($img);

        Brand::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Brand Data Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method


}




