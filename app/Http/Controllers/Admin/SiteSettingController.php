<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function Setting(){

        $setting = SiteSetting::find(1);
        return view('admin.setting.setting_update',compact('setting'));

    } // End Method


    public function SettingUpdate(Request $request){

        $setting_id = $request->id;

        if ($request->file('logo')) {

        $image = $request->file('logo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(180,56)->save('media/logo/'.$name_gen);
        $save_url = 'media/logo/'.$name_gen;


        SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright,
            'logo' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Site Setting Updated with image Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);

        } else {

            SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright,
        ]);

       $notification = array(
            'message' => 'Site Setting Updated without image Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);

        } // end else

    }// End Method



    // Seo Setting ---------------------------------------------------------------------
    public function SeoSetting(){

        $seo = Seo::find(1);
        return view('admin.seo.seo_update',compact('seo'));

    } // End Method


    public function SeoSettingUpdate(Request $request){
        $seo_id = $request->id;

     Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);

       $notification = array(
            'message' => 'Seo Setting Updated Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method

}
