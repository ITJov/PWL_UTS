<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = role::all();
        return view('role.index', [
            'roles' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(),[
            'id'=>'required|string|max:10|unique:role',
            'nama_role'=>'required|string|max:40',
        ],[
            'id.required' => 'Role ID keluarga harus diisi',
            'id.unique' => 'Role ID sudah terdaftar, silahkan diganti dengan nomor lain',
            'nama_role.required' => 'Nama Role harus diisi',
        ])-> validate();

        $role = new role($validateData);
        $role->save();
        return redirect(route('role-index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        return view('role.edit' , [
            'roles' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, role $role)
    {
        $validateData = validator($request->all(), [
            'nama_role  ' => 'required|string|max:45',
        ], [
            'nama_role.required' => 'nama role harus diisi',
        ])-> validate();

        $role->nama_role = $validateData['nama_role'];
        $role->save();
        return redirect(route('role-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(role $role)
    {
        $role->delete();
        return redirect(route('role-index'));
    }
}
