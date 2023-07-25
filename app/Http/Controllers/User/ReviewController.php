<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request){

        $product = $request->product_id;
        $vendor = $request->hvendor_id;

        $request->validate([
            'comment' => 'required',
        ]);

        Review::insert([

            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Review Will Approve By Admin',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    // Admin Review All Part ---------------------------------------------------------
    public function PendingReview(){

        $review = Review::where('status',0)->orderBy('id','DESC')->get();
        return view('admin.review.pending_review',compact('review'));

    }// End Method


    public function ReviewApprove($id){

        Review::where('id',$id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Review Approved Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method


    public function PublishReview(){

        $review = Review::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.review.publish_review',compact('review'));

    }// End Method


    public function ReviewDelete($id){

        Review::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert' => 'success'
        );

        return redirect()->back()->with($notification);
    }// End Method


    // Vendor Order Review -------------------------------------------------------------
    public function VendorPendingOrder(){

        $id = Auth::user()->id;

        $review = Review::where('vendor_id',$id)->where('status',1)->orderBy('id','DESC')->get();
        return view('vendor.review.approve_review',compact('review'));

    }// End Method

}
