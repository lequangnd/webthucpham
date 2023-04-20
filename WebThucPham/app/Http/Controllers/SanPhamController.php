<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Countries;
use App\Models\Details_invoices;
use App\Models\Details_orders;
use App\Models\Details_products;
use App\Models\Invoices;
use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Trademarks;
use App\Models\Units;
use DateTime;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return view('admin.products.index', ['products' => $products]);
    }
    public function add()
    {
        $categories = Categories::all();
        $trademarks = Trademarks::all();
        $countries = Countries::all();
        $suppliers = Suppliers::all();
        return view('admin.products.add', ['categories' => $categories, 'trademarks' => $trademarks, 'countries' => $countries, 'suppliers' => $suppliers]);
    }
    public function addProduct(Request $request)
    {
        $products = new Products();
        $products->name = $request->name;
        $products->categories_id = $request->categories;
        $products->ingredient = $request->ingredient;
        $products->exp = $request->exp;
        $products->trademarks_id = $request->trademarks;
        $products->countries_id = $request->countries;
        $products->description = $request->description;
        $products->image = $request->image;
        $products->save();
        $invoices = new Invoices();
        $invoices->id = $products->id;
        $invoices->date = new DateTime();
        $invoices->suppliers_id = $request->suppliers;
        $invoices->save();
        return redirect()->route('products');
    }

    public function update($id)
    {
        $categories = Categories::all();
        $trademarks = Trademarks::all();
        $countries = Countries::all();
        $suppliers = Suppliers::all();
        $products = Products::find($id);
        $invoices = Invoices::where('id', $id)->first();
        return view('admin.products.update', ['products' => $products, 'invoices' => $invoices, 'categories' => $categories, 'trademarks' => $trademarks, 'countries' => $countries, 'suppliers' => $suppliers]);
    }

    public function updateProduct(Request $request, $id)
    {
        $products = Products::find($id);

        $products->name = $request->name;
        $products->categories_id = $request->categories;
        $products->ingredient = $request->ingredient;
        $products->exp = $request->exp;
        $products->trademarks_id = $request->trademarks;
        $products->countries_id = $request->countries;
        $products->description = $request->description;
        if ($request->image == null) {
            $products->image = $products->image;
        } else {
            $products->image = $request->image;
        }

        $products->save();
        return redirect()->route('products');
    }

    public function details_product($id)
    {
        $details_product = Details_products::where('products_id', $id)->get();
        $units = Units::all();
        return view('admin.products.details_product', ['units' => $units, 'details_product' => $details_product, 'id' => $id]);
    }

    public function add_details_product(Request $request)
    {
        $details_product = new Details_products();
        $dt_product = Details_products::where('products_id', $request->product_id)->get();
        foreach ($dt_product as $dt) {
            if ($request->units == $dt->units_id) {
                return response()->json(['message' => 'ok']);
            }
        }

        $details_product->units_id = $request->units;
        $details_product->products_id = $request->product_id;
        $details_product->quantity = $request->quantity;
        $details_product->import_price = $request->import_price;
        $details_product->price = $request->price;
        $details_product->image = $request->image;
        $details_product->save();
        $details_invoicces = new Details_invoices();
        $details_invoicces->products_id = $request->product_id;
        $details_invoicces->invoices_id = $request->product_id;
        $details_invoicces->units_id = $request->units;
        $details_invoicces->quantity = $request->quantity;
        $details_invoicces->price = $request->import_price;
        $details_invoicces->save();
        $invoices = Invoices::find($request->product_id);
        $total = 0;
        $d_invoices = Details_invoices::where('products_id', $invoices->id)->get();
        foreach ($d_invoices as $d) {
            $total += ($d->quantity * $d->price);
        }
        $invoices->total_money = $total;
        $invoices->save();

        $min = Details_products::where('products_id', $request->product_id)->min('price');
        $products = Products::find($request->product_id);
        $products->price = $min;
        $products->save();
    }

    public function update_details_product(Request $request)
    {
        $details_product = Details_products::find($request->id);
        $details_invoicces = Details_invoices::where('products_id', $request->product_id)->where('units_id', $request->units)->first();
        $dt_orders = Details_orders::where('products_id', $request->product_id)->get();
        $d_invoices = Details_invoices::where('products_id', $request->product_id)->get();
        $d_products=Details_products::where('products_id',$request->product_id)->get();
        $quantity = 0;
        foreach ($dt_orders as $dt) {   
            $quantity += $dt->quantity;
        }
        if ($request->quantity > ($details_invoicces->quantity - $quantity)) {
            return response()->json(['message' => 'ok']);
        }
        foreach ($d_products as $d) {
            if ($request->units != $details_product->units_id && $request->units == $d->units_id) {
                return response()->json(['message' => 'ok']);
            }
        }
        $details_product->units_id = $request->units;
        $details_product->quantity = $request->quantity;
        $details_product->import_price = $request->import_price;
        $details_product->price = $request->price;
        if($request->image==null)
        {
            $details_product->image =  $details_product->image ;
        }else{
            $details_product->image = $request->image;
        }
        $details_product->save();
        //
        $details_invoicces->units_id = $request->units;
        $details_invoicces->price = $request->import_price;
        $details_invoicces->save();
        $invoices = Invoices::find($request->product_id);
        $total = 0;
        $d_invoices = Details_invoices::where('products_id', $invoices->id)->get();
        foreach ($d_invoices as $d) {
            $total += ($d->quantity * $d->price);
        }
        $invoices->total_money = $total;
        $invoices->save();

        $min = Details_products::where('products_id', $request->product_id)->min('price');
        $products = Products::find($request->product_id);
        $products->price = $min;
        $products->save();
    }

    public function delete_details_product(Request $request)
    {
        $details_product = Details_products::find($request->id);
        $details_product->delete();

        $min = Details_products::where('products_id', $request->product_id)->min('price');
        $products = Products::find($request->product_id);
        $products->price = $min;
        $products->save();
    }
}
