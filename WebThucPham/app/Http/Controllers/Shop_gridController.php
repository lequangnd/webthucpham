<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Details_orders;
use App\Models\Details_products;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Shop_gridController extends Controller
{
    public function __construct()
    {
        $categories=Categories::all();
        View::share('categories',$categories);
    }

    public function index()
    {
        $product=Products::all();
        $category=Categories::all();
        return view('backend.shop_grid',['products'=>$product,'category'=>$category]);
    }

    public function price(Request $request)
    {
        $category=Categories::all();
        $products=Products::whereBetween('price',[$request->min,$request->max])->get();
        return view('backend.shop_grid',['products'=>$products,'category'=>$category]);
    }
}
