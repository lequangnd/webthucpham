<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Comments;
use App\Models\Details_orders;
use App\Models\Details_products;
use App\Models\Products;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    public function __construct()
    {
        $categories=Categories::all();
        View::share('categories',$categories);
    }
    
    public function index()
    {
        $produts=Products::all();
        return view('backend.index',['products'=>$produts]);
    }

    public function details($id)
    {
        $comments=Comments::where('products_id',$id)->get();
        $produts=Products::find($id);
        $details_product=Details_products::where('products_id',$id)->first();
        $d__product=Details_products::where('products_id',$id)->get();
        return view('backend.details',['products'=>$produts,'details_product'=>$details_product, 'd_product'=>$d__product,'comments'=>$comments]);
    }
    
    public function category($id)
    {
        $category=Categories::find($id);
        return view('backend.category',['category'=>$category]);
    }

    public function comments($id)
    {
        $details_order=Details_orders::where('products_id',$id)->first();
       return view('backend.comments.index',['details_order'=>$details_order]);
    }

    public function add(Request $request,$id)
    {
        $comments=new Comments();
        $comments->products_id=$id;
        $comments->content=$request->name;
        $comments->date=new DateTime();
        $comments->users_id=Auth::user()->id;
        $comments->save();
    }

    public function search(Request $request)
    {
        $products=Products::where('name','like','%'.$request->name.'%')->get();
        return view('backend.index',['products'=>$products]);
    }
}
