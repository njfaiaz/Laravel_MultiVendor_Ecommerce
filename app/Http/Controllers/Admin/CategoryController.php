<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index',compact('categories'));

    } // End Index Method

    public function add(){
        return view('admin.category.add');

    }// End add Method

    public function Store(Request $request){
        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('media/category/'.$name_gen);
        $save_url = ('media/category/'.$name_gen);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);
        $notification=array(
            'message'=>'Category Image Uploaded Successfully ',
            'alert'=>'success'
        );
        return Redirect()->route('category')->with($notification);

    }// End Method

    public function Edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));

    }// End Method

    public function Update(Request $request){
        $category_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('media/category/'.$name_gen);
            $save_url = ('media/category/'.$name_gen);

            if (file_exists($old_img)) {
                unlink($old_img);
            }

            Category::findOrFail($category_id)->Update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
                'category_image' => $save_url,
            ]);
            $notification=array(
                'message'=>'Category Updated With Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('category')->with($notification);
        } else {
            Category::findOrFail($category_id)->Update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            ]);
            $notification=array(
                'message'=>'Category Updated Without Image Successfully ',
                'alert'=>'success'
            );
            return Redirect()->route('category')->with($notification);
        }
    } // End Method

    public function Delete($id){
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);

        Category::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Category Data Delete Successfully ',
            'alert'=>'success'
        );
        return Redirect()->back()->with($notification);
    } // End Method
}
