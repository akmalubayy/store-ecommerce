<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Comment;


class CommentController extends Controller
{
      public function postComment(Request $request, Product $product)
    {

        // dd($request->all());
        Komentar::create([
            'users_id' => Auth::user()->id,
            'products_id' => $product->id,
            'post' => $request->post,

        ]);

        return redirect()->back()->with('sukses','Komentar Anda Berhasil');
    }
}
