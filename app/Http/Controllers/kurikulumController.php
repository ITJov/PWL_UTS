<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use App\Models\MataKuliah;
use App\Models\role;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'periode'=>'required|string|max:4|unique:kurikulum',
        ],[
            'periode.required' => 'Nama Kurikulum harus diisi',
            'periode.unique' => 'Periode sudah terdaftar, silahkan diganti',
        ])-> validate();

        $id = IdGenerator::generate(['table' => 'kurikulum', 'length' => 10, 'prefix' =>'KRKM-']);

        $kurikulum = new kurikulum($validateData);
        $kurikulum->id=$id;
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
            'periode' => ['required','max:4',Rule::unique('kurikulum')->ignore($kurikulum->id),],
        ], [
            'periode.required' => 'periode harus diisi',
            'periode.unique' => 'Periode sudah terdaftar, silahkan diganti',
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
        $checkMatKul = MataKuliah::where('kurikulum_id', $kurikulum->id)->first();
        if ($checkMatKul) {
            return redirect()->back()->withErrors('Kurikulum sedang terpakai')->withInput();
            }
        else{
            $kurikulum->delete();
            return redirect(route('kurikulum-index'));
        }

    }
}
