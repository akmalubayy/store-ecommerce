<?php

namespace App\Http\Controllers\Admin;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Admin\UserRequest;

use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = User::query();

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
                                <a href="'.route('user.edit', $item->id).'" class="dropdown-item">
                                    Sunting
                                </a>
                                <form action="'. route('user.destroy', $item->id).'" method="POST">
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
            ->rawColumns(['action'])
            ->make();
        }

        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        // dd($data);
        User::create($data);

        return redirect()->route('user.index')->with('sukses','Berhasil Menambahkan User');

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
        $data = User::findOrFail($id);

        return view('pages.admin.user.edit', compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:50',
            'email' => "required|email|unique:users,email,$id",
            'roles' => 'nullable|string|in:ADMIN,USER',
        ));

        $data = $request->all();

        $user = User::findOrFail($id);

        $user->name =$request->name;
        $user->email =$request->email;

        if($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        $user->save();

        return redirect()->route('user.index')->with('sukses','Data User Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('user.index')->with('sukses','Data User Berhasil Dihapus');
    }

}
