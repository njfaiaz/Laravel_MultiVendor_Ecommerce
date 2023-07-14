<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::latest()->get();
        return view('admin.banner.index',compact('banners'));

    } // End Index Method

    public function add(){
        return view('admin.banner.add');

    }// End add Method

    public function Store(Request $request){
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('media/banner/'.$name_gen);
        $save_url = ('media/banner/'.$name_gen);

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Banner Uploaded Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('banner')->with($notification);

    }// End Method

    public function Edit($id){
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner'));

    }// End Method

    public function Update(Request $request){
        $banner_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('banner_image')) {
            $image = $request->file('banner_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('media/banner/'.$name_gen);
            $save_url = ('media/banner/'.$name_gen);

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Banner::findOrFail($banner_id)->Update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification=array(
                'message'=>'Banner Updated With Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('banner')->with($notification);
        } else {
            Banner::findOrFail($banner_id)->Update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
            ]);
            $notification=array(
                'message'=>'Banner Updated Without Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('banner')->with($notification);
        }
    } // End Method

    public function Delete($id){
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img);

        Banner::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Banner Data Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method

}
