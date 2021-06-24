<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\ProductGallery;
use App\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\ProductGalleryRequest;

use Yajra\DataTables\Facades\DataTables;



class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            $query = ProductGallery::with(['product']);

            return DataTables::of($query)
            ->addColumn('action', function($item) {
                return '
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                    type="button"
                                    data-toggle="dropdown">
                                    Aksi
                            </button>
                            <div class="dropdown-menu">
                                <a href="'.route('gallery.edit', $item->id).'" class="dropdown-item">
                                    Sunting
                                </a>
                                <form action="'. route('gallery.destroy', $item->id).'" method="POST">
                                    '. method_field('delete') . csrf_field() .'
                                    <button type="submit" class="dropdown-item text-danger" onClick="return confirm(\'Anda Yakin ingin mengapus data ini?\')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ';
            })
            ->editColumn('photo_url', function($item) {
                // Ternary conditional
                return $item->photo_url ? '<img src="'. Storage::url($item->photo_url).'" style="max-height:80px;"/>' : '';
            })
            ->rawColumns(['action','photo_url'])
            ->make();
        }

        return view('pages.admin.product-gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.admin.product-gallery.create', compact([
            'products',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/product','public');

        ProductGallery::create($data);

        return redirect()->route('gallery.index')->with('sukses','Data Image Product Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = ProductGallery::findOrFail($id);
        $products = Product::all();

        return view('pages.admin.product-gallery.edit', compact([
            'item',
            'products',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductGalleryRequest $request, $id)
    {
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/product','public');

        $item = ProductGallery::findOrFail($id);
        $item->update($data);
        $item->save();

        return redirect()->route('gallery.index')->with('sukses','Data Produk Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ProductGallery::findOrFail($id);

        $data->delete();

        return redirect()->route('gallery.index')->with('sukses','Data Produk Berhasil Dihapus');
    }
}
