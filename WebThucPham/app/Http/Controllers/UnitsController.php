<?php

namespace App\Http\Controllers;

use App\Models\Units;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function index()
    {
        $units=Units::all();
        return view('admin.units.index',['units'=>$units]);
    }

    public function add(Request $request)
    {
        $category=new Units();
        $category->name=$request->name;
        $category->save();
    }

    public function update(Request $request)
    {
        $category= Units::find($request->id);
        $category->name=$request->name;
        $category->save();
    }

    public function delete(Request $request)
    {
        $category= Units::find($request->id);
        $category->delete();
    }
}
