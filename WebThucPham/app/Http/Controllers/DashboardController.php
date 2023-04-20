<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Orders;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $now=Carbon::now();
        $user=User::all();
        $order=Orders::all();
        $comments=Comments::all();
        $order=Orders::whereMonth('order_date',$now->month)->selectRaw('order_date,SUM(total_money) as value')->groupBy('order_date')->get();
        $donut=Orders::whereMonth('order_date',$now->month)->selectRaw('order_date as label,SUM(total_money) as value')->groupBy('order_date')->get();
        return view('admin.dashboard.index',['user'=>$user,'order'=>$order,'comments'=>$comments,'order'=>$order,'donut'=>$donut]);
    }
    public function day(Request $request)
    {
        $user=User::whereDate('created_at',$request->data)->count();
        $comments=Comments::whereDate('created_at',$request->data)->count();
        $order=Orders::whereDate('order_date',$request->data)->count();
        $money=Orders::whereDate('order_date',$request->data)->get();
        $total=0;
        foreach($money as $m)
        {
            $total +=$m->total_money;
        }
        return response()->json(['order'=>$order,'total'=>$total,'user'=>$user,'comments'=>$comments]);
    }

    public function month(Request $request)
    {
        $user=User::whereMonth('created_at',$request->month)->whereYear('created_at',$request->year)->count();
        $comments=Comments::whereMonth('created_at',$request->month)->whereYear('created_at',$request->year)->count();
        $order=Orders::whereMonth('order_date',$request->month)->whereYear('created_at',$request->year)->count();
        $money=Orders::whereMonth('order_date',$request->month)->whereYear('order_date',$request->year)->get();
        $total=0;

        foreach($money as $m)
        {
            $total +=$m->total_money;
        }
        return response()->json(['order'=>$order,'total'=>$total,'user'=>$user,'comments'=>$comments]);
    }

    public function year(Request $request)
    {
        $user=User::whereYear('created_at',$request->year)->count();
        $comments=Comments::whereYear('created_at',$request->year)->count();
        $order=Orders::whereYear('order_date',$request->year)->count();
        $money=Orders::whereYear('order_date',$request->year)->get();
        $total=0;
        foreach($money as $m)
        {
            $total +=$m->total_money;
        }
        return response()->json(['order'=>$order,'total'=>$total,'user'=>$user,'comments'=>$comments]);
    }
}
