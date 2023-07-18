<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function AddToCompare(Request $request ,$product_id){
        if (Auth::check()) {
            $exists = Compare::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully Add On Your Compare']);
            } else {
                return response()->json(['error' => 'This Product Has Already On Your Compare']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
       } // End Method



 //    Compare page ------------------------------------------------

   public function allCompare(){
    return view('frontend.product.compare');
 } // End Method


 public function getCompareProduct(){
    $compare = Compare::with('product')->where('user_id',Auth::id())->latest()->get();
    $compQty = Compare::count();

    return response()->json(['compare' => $compare, 'compQty' => $compQty]);
 } // End Method


 public function compareRemove($id){
    Compare::where('user_id',Auth::id())->where('id',$id)->delete();
    return response()->json(['success' => 'Successfully Product Remove']);
   } // End Method


}
