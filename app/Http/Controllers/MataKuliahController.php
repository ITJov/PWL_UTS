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

        return view('mata_kuliah.create', [
            'mk' => kurikulum::all()
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
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        return view('mata_kuliah.edit' , [
            'mk' => $mataKuliah,
            'kurikulums'=> kurikulum::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update  (Request $request, MataKuliah $mataKuliah)
    {
        $validateData = validator($request->all(), [
            'nama_mata_kuliah' => 'required|string|max:45',
            'sks' => 'required|string|max:2',
            'kurikulum_id' => 'required|string|max:10',
        ], [
            'nama_mata_kuliah.required' => 'nama mata kuliah keluarga harus diisi',
        ])-> validate();

        $mataKuliah->nama_mata_kuliah = $validateData['nama_mata_kuliah'];
        $mataKuliah->sks = $validateData['sks'];
        $mataKuliah->kurikulum_id = $validateData['kurikulum_id'];
        $mataKuliah->save();
        return redirect(route('mk-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return redirect(route('mk-index'));
    }
    public function tipe()

    {
        return $this->belongsTo('App\Models\kurikulum');
    }

}
