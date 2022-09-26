<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $todayDate=Carbon::now();
        // $order=Order::whereDate('created_at',$todayDate)->paginate(10);

        $todayDate=Carbon::now()->format('Y-m-d');
        $order=Order::when($request->date != null,function($q) use ($request){
            return $q->whereDate('created_at',$request->date);
        }
        // ,function($q) use ($todayDate){
        //     return $q->whereDate('created_at',$todayDate);
        // }
        )->when($request->status !=null,function($q) use ($request){
            return $q->where('status',$request->status);
        })->paginate(10);



        return view('admin.order.index',compact('order'));
    }

    public function show(int $orderId)
    {
        $order=Order::where('id',$orderId)->first();
        if($order){
            return view('admin.order.view',compact('order'));
        }else{
            return redirect('admin/order')->with('message','Order Id Not Found');
        }
    }

    public function updateOrderStatus(int $orderId , Request $request)
    {
        $order=Order::where('id',$orderId)->first();
        if($order){

            $order->update([
                'status'=> $request->order_status
            ]);
            return redirect('admin/order/'.$orderId)->with('message','Order Status Updated');
        }else{
            return redirect('admin/order/'.$orderId)->with('message','Order Id Not Found');
        }
    }

    public function viewInvoice(int $orderId)
    {

        $order=Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice',compact('order'));
    }

    public function downloadInvoice(int $orderId)
    {
        $order=Order::findOrFail($orderId);
        $data=['order'=>$order];

        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        $todayDate=Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice -'.$order->id.'-'.$todayDate.'.pdf');
    }
}
