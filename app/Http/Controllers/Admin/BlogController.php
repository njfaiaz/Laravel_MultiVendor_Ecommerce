<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlogCategory(){

        $blogcategoryies = BlogCategory::latest()->get();
        return view('admin.blog.category.blogcategroy_all',compact('blogcategoryies'));

    } // End Method


    public function AddBlogCategory(){
        return view('admin.blog.category.add');
    } // End Method



    public function StoreBlogCategory(Request $request){

        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);

       $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification);

    }// End Method


    public function EditBlogCategory($id){

        $blogcategoryies = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit',compact('blogcategoryies'));

    }// End Method

     public function UpdateBlogCategory(Request $request){

      $blog_id = $request->id;

        BlogCategory::findOrFail($blog_id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
        ]);

       $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification);

    }// End Method


    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method




//   ----------------------------- Blog Post Methods ----------------------------


 public function AllBlogPost(){

    $blogpost = BlogPost::latest()->get();
    return view('admin.blog.post.blogpost_all',compact('blogpost'));

} // End Method


    public function AddBlogPost(){
        $blogcategory = BlogCategory::latest()->get();
        return view('admin.blog.post.blogpost_add',compact('blogcategory'));
    } // End Method



    public function StoreBlogPost(Request $request){

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1103,906)->save('media/blog/'.$name_gen);
        $save_url = 'media/blog/'.$name_gen;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
                'message' => 'Blog Post Inserted Successfully',
                'alert' => 'success'
            );

        return redirect()->route('admin.blog.post')->with($notification);

    }// End Method



    public function EditBlogPost($id){
        $blogcategory = BlogCategory::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
       return view('admin.blog.post.edit',compact('blogcategory','blogpost'));
   }// End Method


    public function UpdateBlogPost(Request $request){

       $post_id = $request->id;
       $old_img = $request->old_image;

       if ($request->file('post_image')) {
       $image = $request->file('post_image');
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(1103,906)->save('media/blog/'.$name_gen);
       $save_url = 'media/blog/'.$name_gen;

       if (file_exists($old_img)) {
          unlink($old_img);
       }

       BlogPost::findOrFail($post_id)->update([
           'category_id' => $request->category_id,
           'post_title' => $request->post_title,
           'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
           'post_short_description' => $request->post_short_description,
           'post_long_description' => $request->post_long_description,
           'post_image' => $save_url,
           'updated_at' => Carbon::now(),
       ]);

      $notification = array(
           'message' => 'Blog Post Updated with image Successfully',
           'alert' => 'success'
       );

       return redirect()->route('admin.blog.post')->with($notification);

       } else {

           BlogPost::findOrFail($post_id)->update([
           'category_id' => $request->category_id,
           'post_title' => $request->post_title,
           'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
           'post_short_description' => $request->post_short_description,
           'post_long_description' => $request->post_long_description,
           'updated_at' => Carbon::now(),
       ]);

      $notification = array(
           'message' => 'Blog Post Updated without image Successfully',
           'alert' => 'success'
       );

       return redirect()->route('admin.blog.post')->with($notification);

       } // end else

   }// End Method

    public function DeleteBlogPost($id){

       $blogpost = BlogPost::findOrFail($id);
       $img = $blogpost->post_image;
       unlink($img );
       BlogPost::findOrFail($id)->delete();
       $notification = array(
           'message' => 'Blog Post Deleted Successfully',
           'alert' => 'success'
       );

       return redirect()->back()->with($notification);

   }// End Method
}
