<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
   public function AddToWishlist(Request $request ,$product_id){
    if (Auth::check()) {
        $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

        if (!$exists) {
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),
            ]);
            return response()->json(['success' => 'Successfully Add On Your Wishlist']);
        } else {
            return response()->json(['error' => 'This Product Has Already On Your Wishlist']);
        }
    } else {
        return response()->json(['error' => 'At First Login Your Account']);
    }
   } // End Method


//    Wishlist page ------------------------------------------------

   public function allWishlist(){
      return view('frontend.product.wishlist');
   } // End Method


//    Wishlist view page ---------------------------------------------------

   public function getWishlistProduct(){
      $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
      $wishQty = Wishlist::count();

      return response()->json(['wishlist' => $wishlist, 'wishQty' => $wishQty]);
   } // End Method

   public function WishlistRemove($id){
    Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
    return response()->json(['success' => 'Successfully Product Remove']);
   } // End Method










}
