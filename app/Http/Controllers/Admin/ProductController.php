<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('admin.product.index',compact('products'));

    } // End Index Method


    public function add(){
        $activeVendor = User::where('status','active')->where('role_id','3')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('admin.product.add',compact('activeVendor','brands','categories'));
    } // End Method

    public function Store(Request $request){
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1100,1100)->save('media/product/'.$name_gen);
        $save_url = ('media/product/'.$name_gen);

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_disc' => $request->short_disc,
            'long_disc' => $request->long_disc,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // Multiple Image Uploaded -----------------------------------------------------
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(1100,1100)->save('media/multiImage/'.$make_name);
            $uploadPath = 'media/multiImage/'.$make_name;

            MultiImage::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        } // Multi Image Method End
        $notification=array(
            'message'=>'Product All Information Add Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('product')->with($notification);


    } // End Method

    public function Edit($id){
        $multi_image = MultiImage::where('product_id',$id)->get();
        $activeVendor = User::where('status','active')->where('role_id','3')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $product = Product::findOrFail($id);
        return view('admin.product.edit',compact('activeVendor','brands','categories','subcategories','product','multi_image'));

    } // End Method

    public function Update(Request $request){
        $product_id = $request->id;

            Product::findOrFail($product_id)->Update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_disc' => $request->short_disc,
            'long_disc' => $request->long_disc,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Product Update Without Image Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('product')->with($notification);

    } // End Method

    // Main Image Update Code ---------------------------------------

    public function MainImageUpdate(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1100,1100)->save('media/product/'.$name_gen);
        $save_url = ('media/product/'.$name_gen);

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
        Product::findOrFail($pro_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Product Image Update Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    }// End Method


    // MultiImage Update ----------------------------------------------

    public function MultiImageUpdate (Request $request){
        $imgs = $request ->multi_images;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(1100,1100)->save('media/multiImage/'.$make_name);
            $uploadPath = 'media/multiImage/'.$make_name;

            MultiImage::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
            $notification=array(
                'message'=>'Product Multiple Image Update Successfully ',
                'alert'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    } /// end method


    // MultiImage Delete ---------------------------------------------------------------------

    public function MultiImageDelete ($id){
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImage::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Product Multiple Image Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // end method


    public function ProductInactive($id){
        Product::findOrFail($id)->Update(['status' => 0]);
        $notification=array(
            'message'=>'Product InActive Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // end method


    public function ProductActive($id){
        Product::findOrFail($id)->Update(['status' => 1]);
        $notification=array(
            'message'=>'Product Active Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // end method

    public function Delete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImage::where('product_id',$id)->get();
        foreach ($images as  $img) {
            unlink($img->photo_name);
            MultiImage::where('product_id',$id)->delete();
        }
        $notification=array(
            'message'=>'Product Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End method

    // Product Stock Manage -------------------------------------------------------------

    public function ProductStock(){

        $products = Product::latest()->get();
        return view('admin.product.product_stock',compact('products'));

    }// End Method


}
