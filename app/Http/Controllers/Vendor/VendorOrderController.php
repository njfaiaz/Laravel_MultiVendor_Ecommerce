<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function PendingOrder(){
        $id = Auth::user()->id;
        $orders = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        return view('vendor.order.index',compact('orders'));
    } // End Method



    public function ReturnOrder(){

        $id = Auth::user()->id;
       $orderItem = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
       return view('vendor.order.return_order',compact('orderItem'));

   } // End Method


    public function CompleteReturnOrder(){

    $id = Auth::user()->id;
    $orderItem = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
    return view('vendor.order.complete_return',compact('orderItem'));

    } // End Method

    public function OrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('vendor.order.order_details',compact('order','orderItem'));

    }// End Method





}
