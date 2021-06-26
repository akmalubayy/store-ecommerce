<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;


use App\Product;
use App\Comment;


class CommentController extends Controller
{
      public function postComment(CommentRequest $request, Product $product)
    {

        // dd($request->all());
        Comment::create([
            'users_id' => Auth::user()->id,
            'products_id' => $product->id,
            'post' => $request->post,

        ]);

        return redirect()->back()->with('sukses','Komentar Anda Berhasil');
    }
}
