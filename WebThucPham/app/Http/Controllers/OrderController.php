<?php

namespace App\Http\Controllers;

use App\Models\Details_invoices;
use App\Models\Details_orders;
use App\Models\Invoices;
use App\Models\Order_status;
use App\Models\Orders;
use  Barryvdh\DomPDF\Facade\PDF;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order=Orders::all();
        $order_status=Order_status::all();
        return view('admin.orders.index',['orders'=>$order, 'order_status'=>$order_status]);
    }
    
    public function details($id)
    {
        $order=Details_orders::where('orders_id',$id)->get();
        return view('admin.orders.details',['orders'=>$order]);
    }


    public function status(Request $request)
    {
        $order=Orders::find($request->id);
        $order->order_status_id=$request->status_id;
        if($request->status_id==4)
        {
            $order->shipped_date=new DateTime();
        }
        $order->save();
        $details_order=Details_orders::where('orders_id',$request->id)->get();
        foreach($details_order as $d)
        {
            $d->status_id=$order->order_status_id;
            $d->save();
        }
    }

    public function invoice()
    {
        $invoice=Invoices::all();
        return view('admin.orders.invoice',['invoice'=>$invoice]);
    }

    public function details_invoice($id)
    {
        $invoice=Details_invoices::where('invoices_id',$id)->get();
        return view('admin.orders.details_invoice',['invoice'=>$invoice]);
    }

    public function pdf($id)
    {
        $data=Orders::find($id);
        $details=Details_orders::where('orders_id',$id)->get();
        $pdf=PDF::loadView('user.pdf',['order'=>$data,'details'=>$details]);
        return $pdf->stream();
    }
}
