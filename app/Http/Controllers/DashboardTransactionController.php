<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\TransactionDetail;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellTransactions = TransactionDetail::with([
            'transaction.user',
            'product.galleries'
        ])->whereHas('product', function($product) {
            $product->where('users_id', Auth::user()->id);
        })->get();

        $buyTransactions = TransactionDetail::with([
            'transaction.user',
            'product.galleries'
        ])->whereHas('transaction', function($transaction) {
            $transaction->where('users_id', Auth::user()->id);
        })->get();

        return view('pages.dashboard-transactions', compact([
            'sellTransactions',
            'buyTransactions',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with([
            'transaction.user',
            'product.galleries'
        ])->findOrFail($id);

        return view('pages.dashboard-transactions-details', compact([
            'transaction'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-transactions-details', $id)->with('sukses','Data Transaksi Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
