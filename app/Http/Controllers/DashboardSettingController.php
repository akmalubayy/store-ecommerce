<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Category;

class DashboardSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function index()
   {

   }

   public function accountSetting()
   {
        $user = Auth::user();

        return view('pages.dashboard-account-settings', compact([
            'user'
        ]));
   }

    public function storeSetting()
    {

        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard-store-settings', compact([
           'user',
           'categories'
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $redirect)
    {
        $this->validate($request, array(
            'photo_url' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ));

        $data = $request->all();

        $item = Auth::user();

        // $data['photo_url'] = $request->file('photo_url')->store('assets/user','public');

        if($request->hasFile('photo_url'))
        {
                //upload it
                $data['photo_url'] = $request->file('photo_url')->store('assets/user','public');

                //delete old image
                Storage::delete(Auth::user()->photo_url);

                $data['photo_url'] = $request->file('photo_url')->store('assets/user','public');
        }

        $item->update($data);

        return redirect()->route($redirect)->with('sukses','Data Store Berhasil Diupdate');
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
