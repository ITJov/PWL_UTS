<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use App\Models\role;
use Illuminate\Http\Request;

class kurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kurikulum::all();
        return view('kurikulum.index', [
            'kurikulums' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kurikulum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(),[
            'id'=>'required|string|max:10|unique:kurikulum',
            'periode'=>'required|string|max:4',
        ],[
            'id.required' => 'Kurikulum ID keluarga harus diisi',
            'id.unique' => 'Kurikulum ID sudah terdaftar, silahkan diganti dengan nomor lain',
            'periode.required' => 'Nama Kurikulum harus diisi',
        ])-> validate();

        $kurikulum = new kurikulum($validateData);
        $kurikulum->save();
        return redirect(route('kurikulum-index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(kurikulum $kurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kurikulum $kurikulum)
    {
        return view('kurikulum.edit' , [
            'kurikulums' => $kurikulum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kurikulum $kurikulum)
    {
        $validateData = validator($request->all(), [
            'periode' => 'required|string|max:4',
        ], [
            'periode.required' => 'periode harus diisi',
        ])-> validate();

        $kurikulum->periode = $validateData['periode'];
        $kurikulum->save();
        return redirect(route('kurikulum-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kurikulum $kurikulum)
    {
        $kurikulum->delete();
        return redirect(route('kurikulum-index'));
    }
}
