<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AllUserController extends Controller
{
    public function UserAccount(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.user.account_details',compact('userData'));

    } // End Method


    public function ChangePassword(){
        return view('frontend.user.change_password');
    } // End Method


    public function UserOrder(){
        $id = Auth::user()->id;
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('frontend.user.order',compact('orders'));
    } // End Method

    // User Order Details ---------------------------------------------------------

    public function OrderDetails($order_id){
        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.user.order_details',compact('order','orderItem'));
    } // End method



    public function OrderInvoice($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.user.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method



    public function ReturnOrder(Request $request,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);
        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert' => 'success'
        );

        return redirect()->route('user.order.page')->with($notification);

    }// End Method



    public function ReturnOrderPage(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.user.return_order_view',compact('orders'));

    }// End Method
}
