<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Nette\Utils\Json;

class HeartController extends Controller
{
    public function __construct()
    {
        $categories = Categories::all();
        View::share('categories', $categories);
    }

    public function heart()
    {
        $heart=session()->get('heart');
        return view('backend.heart',['heart'=>$heart]);
    }

    public function add(Request $request)
    {
        $products=Products::find($request->id);
        $heart=session()->get('heart');
        if(isset($heart[$request->id]))
        {
            return response()->json(['message'=>'ok']);
        }
        $heart[$request->id]=[
            'id'=>$products->id,
            'name'=>$products->name,
            'price'=>$products->price,
            'image'=>$products->image,
            'trademark'=>$products->trademarks->name,
            'country'=>$products->countries->name,
        ];
        session()->put('heart',$heart);
    }

    public function delete(Request $request)
    {
        $heart=session()->get('heart');
        unset($heart[$request->id]);
        session()->put('heart',$heart);
    }
}
