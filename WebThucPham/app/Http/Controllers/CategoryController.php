<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Categories::all();
        return view('admin.category.index',['category'=>$category]);
    }

    public function add(Request $request)
    {
        $category=new Categories();
        $category->name=$request->name;
        $category->save();
    }

    public function update(Request $request)
    {
        $category= Categories::find($request->id);
        $category->name=$request->name;
        $category->save();
    }

    public function delete(Request $request)
    {
        $category= Categories::find($request->id);
        $category->delete();
    }
}
