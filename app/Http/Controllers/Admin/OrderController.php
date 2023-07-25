<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


    public function AllOrder(){
        $orders = Order::orderBy('id','DESC')->get();
        return view('admin.order.all_order',compact('orders'));
    } // End Method


    public function PendingOrder(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.order.pending',compact('orders'));
    } // End Method


    public function AdminOrderDetails($id){
        $order = Order::with('division','district','state','user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','DESC')->get();

        return view('admin.order.order_details',compact('order','orderItem'));
    } // End Method

    public function ConfirmedOrder(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.order.confirmed',compact('orders'));
    } // End Method

    public function ProcessingOrder(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('admin.order.processing',compact('orders'));
    } // End Method

    public function DeliveredOrder(){
        $orders = Order::where('status','deliverd')->orderBy('id','DESC')->get();
        return view('admin.order.delivered',compact('orders'));
    } // End Method



    public function PendingToConfirm($order_id){
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert' => 'success'
        );
        return redirect()->route('admin.confirmed.order')->with($notification);
    }// End Method


    public function ConfirmToDelivered($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert' => 'success'
        );
        return redirect()->route('admin.processing.order')->with($notification);
    }// End Method




    public function ProcessingToDelivered($order_id){

        $product = OrderItem::where('order_id',$order_id)->get();
        foreach($product as $item){
            Product::where('id',$item->product_id)->update(['product_qty' => DB::raw('product_qty-'.$item->qty) ]);

        }
        Order::findOrFail($order_id)->update(['status' => 'deliverd']);
        $notification = array(
            'message' => 'Order Deliverd Successfully',
            'alert' => 'success'
        );
        return redirect()->route('admin.delivered.order')->with($notification);
    }// End Method



    public function InvoiceDownload($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('admin.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method
}
