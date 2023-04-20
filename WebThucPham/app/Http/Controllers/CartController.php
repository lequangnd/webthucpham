<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Details_orders;
use App\Models\Details_products;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Units;
use DateTime;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function __construct()
    {
        $categories = Categories::all();
        View::share('categories', $categories);
    }

    public function cart()
    {
        $cart = session()->get('cart');
        return view('backend.cart', ['cart' => $cart]);
    }

    public function addCart(Request $request)
    {
        if($request->units_id==null)
        {
            return response()->json(['message'=>'ok']);
        }
        $cart = session()->get('cart');
        if (isset($cart[$request->id . $request->units_id])) {
            $cart[$request->id . $request->units_id]['quantity'] = $cart[$request->id . $request->units_id]['quantity'] + 1;
        } else {
            $cart[$request->id . $request->units_id] = [
                'id' => $request->id,
                'name' => $request->name,
                'units_id' => $request->units_id,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'image' => $request->image
            ];
        }
        session()->put('cart', $cart);
        print_r($cart);
    }

    public function deleteCart(Request $request)
    {
        $cart = session()->get('cart');
        unset($cart[$request->id]);
        session()->put('cart', $cart);
    }

    public function checkout()
    {
        $cart=session()->get('cart');
        $units=Units::all();
        return view('backend.checkout',['cart'=>$cart, 'units'=>$units]);
    }

    public function updateCart(Request $request)
    {
        $data = $request->data;
        foreach ($data as $d) {
            $cart = session()->get('cart');
            $cart[$d['id']]['quantity'] = $d['quantity'];
            session()->put('cart', $cart);
        }
    }

    public function order(Request $request)
    {
        $cart=session()->get('cart');
        $order=new Orders();
        $order->users_id=Auth::user()->id;
        $order->order_status_id=1;
        $order->username=$request->name;
        $order->phone=$request->phone;
        $order->address=$request->address;
        $order->order_date=new DateTime();
        $total=0;
        foreach($cart as $c)
        {
            $total +=$c['price'] * $c['quantity'];
        }
        $order->total_money=$total;
        $order->save();
        foreach($cart as $c)
        {
            $details_order=new Details_orders();
            $details_order->products_id=$c['id'];
            $details_order->orders_id=$order->id;
            $details_order->units_id=$c['units_id'];
            $details_order->quantity=$c['quantity'];
            $details_order->price=$c['price'];
            $details_order->status_id=1;
            $details_order->save();
            $details_products=Details_products::where('products_id',$c['id'])->where('units_id',$c['units_id'])->first();
            $details_products->quantity=$details_products->quantity -$c['quantity'];
            $details_products->save();
        }
        session()->forget('cart');
        return redirect()->route('index');
    }

    public function user_order($id)
    {
        $order=Orders::where('users_id',$id)->get();
        return view('backend.order',['order'=>$order]);
    }

    public function user_order_details($id)
    {
        $order=Details_orders::where('orders_id',$id)->get();
        return view('backend.order_details',['order'=>$order]);
    }
    public function delete_order_details($id)
    {
        $details_order=Details_orders::where('orders_id',$id)->get();
        foreach($details_order as $d)
        {
            $details_products=Details_products::where('products_id',$d->products_id)->where('units_id',$d->units_id)->first();
            $details_products->quantity=$details_products->quantity + $d->quantity;
            $details_products->save();
        }
       
        Details_orders::where('orders_id',$id)->delete();
        $order=Orders::find($id);
        $order->delete();
        return redirect()->route('user-order',Auth::user()->id);
    }

    public function add_cart(Request $request)
    {
        $p=Products::find($request->id);
        $product=Details_products::where('products_id',$p->id)->first();
        $cart=session()->get('cart');
        if(isset($cart[$request->id.$product->units_id]))
        {
            $cart[$request->id.$product->units_id]['quantity']=$cart[$request->id.$product->units_id]['quantity'] +1;
        }else{
            $cart[$request->id.$product->units_id]=[
                'id'=>$request->id,
                'name'=>$product->products->name,
                'units_id'=>$product->units_id,
                'price'=>$product->price,
                'quantity'=>1,
                'image'=>$request->image,
            ];
        }
        session()->put('cart',$cart);
    }
}
