<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


use App\Product;
use App\User;
use App\Category;
use App\ProductGallery;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'galleries',
            'category',
        ])->where('users_id', Auth::user()->id)->get();

        return view('pages.dashboard-products', compact([
            'products'
        ]));
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboard-products-create', compact([
            'categories'
        ]));
    }


    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photo_url' => $request->file('photo_url')->store('assets/product','public')
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product')->with('sukses','Data Product Berhasil Ditambah');
    }

    public function details(Request $request, $id)
    {
        $product = Product::with([
            'galleries',
            'user',
            'category'
        ])->findOrFail($id);

        $categories = Category::all();

        return view('pages.dashboard-products-details', compact([
            'product',
            'categories'
        ]));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product')->with('sukses','Data Produk Berhasil Diupdate');
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/product','public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id)->with('sukses','Data Image Product Berhasil Ditambah');
    }

    public function deleteGallery(Request $request, $id)
    {

        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id)->with('sukses','Data Produk Berhasil Dihapus');
    }
}
