<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $country=Countries::all();
        return view('admin.country.index',['country'=>$country]);
    }

    public function add(Request $request)
    {
        $category=new Countries();
        $category->name=$request->name;
        $category->save();
    }

    public function update(Request $request)
    {
        $category= Countries::find($request->id);
        $category->name=$request->name;
        $category->save();
    }

    public function delete(Request $request)
    {
        $category= Countries::find($request->id);
        $category->delete();
    }
}
