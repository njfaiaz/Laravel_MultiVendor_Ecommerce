<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        return view('admin.slider.index',compact('sliders'));

    } // End Index Method

    public function add(){
        return view('admin.slider.add');

    }// End add Method

    public function Store(Request $request){
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('media/slider/'.$name_gen);
        $save_url = ('media/slider/'.$name_gen);

        Slider::insert([
            'slider_title' => $request->slider_title,
            'slider_short_title' => $request->slider_short_title,
            'slider_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Slider Uploaded Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('slider')->with($notification);

    }// End Method

    public function Edit($id){
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));

    }// End Method

    public function Update(Request $request){
        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(2376,807)->save('media/slider/'.$name_gen);
            $save_url = ('media/slider/'.$name_gen);

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Slider::findOrFail($slider_id)->Update([
                'slider_title' => $request->slider_title,
                'slider_short_title' => $request->slider_short_title,
                'slider_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification=array(
                'message'=>'Slider Updated With Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->Update([
                'slider_title' => $request->slider_title,
                'slider_short_title' => $request->slider_short_title,
            ]);
            $notification=array(
                'message'=>'Slider Updated Without Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('slider')->with($notification);
        }
    } // End Method

    public function Delete($id){
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slider::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Slider Data Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method
}
