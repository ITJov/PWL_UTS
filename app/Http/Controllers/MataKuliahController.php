<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use App\Models\MataKuliah;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MataKuliah::all();
        return view('mata_kuliah.index', [
            'mks' => $data
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
            'nama_mata_kuliah'=>'required|string|max:40|unique:mata_kuliah',
            'sks'=>'required|string|max:2',
            'kurikulum_id'=>'required|string|max:40',
        ],[
            'nama_mata_kuliah.required' => 'Nama Mata Kuliah harus diisi',
            'nama_mata_kuliah.unique' => 'Nama Mata kuliah sudah terdaftar, silahkan diganti dengan mata kuliah lain',
            'sks.required' => 'Jumlah SKS harus diisi',
            'kurikulum_id.required' => 'Kurikulum harus diisi',
        ])-> validate();

        $id = IdGenerator::generate(['table' => 'mata_kuliah', 'length' => 10, 'prefix' =>'MK-']);

        $matKul = new MataKuliah($validateData);
        $matKul->id = $id;
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
            'nama_mata_kuliah' => ['required','max:45',Rule::unique('mata_kuliah')->ignore($mataKuliah->id),],
            'sks' => 'required|string|max:2',
            'kurikulum_id' => 'required|string|max:10',
        ], [
            'nama_mata_kuliah.required' => 'Nama mata kuliah harus diisi',
            'nama_mata_kuliah.unique' => 'Nama mata kuliah sudah pernah didaftarkan',
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

}
