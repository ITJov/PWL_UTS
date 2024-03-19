<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MataKuliah::all();
        return view('mata_kuliah.index', [
            'mk' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = kurikulum::all();
        return view('mata_kuliah.create', [
            'mk' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validateData = validator($request->all(),[
            'kode_mata_kuliah'=>'required|string|max:10|unique:mata_kuliah',
            'nama_mata_kuliah'=>'required|string|max:40',
            'sks'=>'required|string|max:2',
            'kurikulum_id'=>'required|string|max:40',
        ],[
            'kode_mata_kuliah.required' => 'Kode Mata kuliah harus diisi',
            'kode_mata_kuliah.unique' => 'Kode Mata kuliah sudah terdaftar, silahkan diganti dengan nomor lain',
            'nama_mata_kuliah.required' => 'Nama Mata Kuliah harus diisi',
            'sks.required' => 'Jumlah SKS harus diisi',
            'kurikulum_id.required' => 'Kurikulum harus diisi',
        ])-> validate();

        $matKul = new MataKuliah($validateData);
        $matKul->save();
        return redirect(route('mk-index'))->with('flash_message', 'Mata Kuliah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function tipe()
    {
        return $this->belongsTo('App\Models\kurikulum');
    }

}
