<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier=Suppliers::all();
        return view('admin.supplier.index',['supplier'=>$supplier]);
    }

    public function add(Request $request)
    {
        $category=new Suppliers();
        $category->name=$request->name;
        $category->save();
    }

    public function update(Request $request)
    {
        $category= Suppliers::find($request->id);
        $category->name=$request->name;
        $category->save();
    }

    public function delete(Request $request)
    {
        $category= Suppliers::find($request->id);
        $category->delete();
    }
}
