<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use App\Models\PollingDetail;
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
//        dd($request);
      $validateData = validator($request->all(),[
            'nama_mata_kuliah'=>'required|string|max:40',
            'sks'=>'required|int|max:24|min:1',
            'kurikulum_id'=>'required|string|max:40',
        ],[
            'nama_mata_kuliah.required' => 'Nama Mata Kuliah harus diisi',
            'sks.required' => 'Jumlah SKS harus diisi',
            'kurikulum_id.required' => 'Kurikulum harus diisi',
            'sks.min' => 'SKS tidak bisa dibawah 1',
            'sks.max'=>'SKS tidak bisa melebihi 24',
        ])-> validate();

        $id = IdGenerator::generate(['table' => 'mata_kuliah', 'length' => 10, 'prefix' =>'MK-']);
        $data=false;
        if(MataKuliah::all()->isEmpty()){
            $data=true;
        }else{
            foreach (MataKuliah::all() as $data ){
                if($data['nama_mata_kuliah'] == $request->nama_mata_kuliah ){
                    if($data['kurikulum_id'] == $request->kurikulum_id ) {
                        return redirect()->back()->withErrors('Mata Kuliah dengan periode ini sudah pernah didaftarkan')->withInput();
                    }
                    else{
                        $data=true;
                    }
                }elseif($data ==null){
                    $data=true;
                }
            }
        }

        if($data){
            $matKul = new MataKuliah($validateData);
            $matKul->id = $id;
            $matKul->save();
            return redirect(route('mk-index'))->with('flash_message', 'Mata Kuliah ditambahkan');
        }
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
            'nama_mata_kuliah' =>'required|string|max:40',
            'sks'=>'required|int|max:24|min:1',
            'kurikulum_id' => 'required|string|max:10',
        ], [
            'nama_mata_kuliah.required' => 'Nama mata kuliah harus diisi',
            'sks.min' => 'SKS tidak bisa dibawah 1',
            'sks.max'=>'SKS tidak bisa melebihi 24',
        ])-> validate();

        $request->validate([
            'nama_mata_kuliah' => 'unique:mata_kuliah,nama_mata_kuliah,'.$mataKuliah->id.',id,kurikulum_id,'.$validateData['kurikulum_id']
        ], [
            'nama_mata_kuliah.unique' => 'Nama mata kuliah dengan kurikulum yang sama sudah terdaftar.'
        ]);

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
        $checkMatKul = PollingDetail::where('mata_kuliah_id', $mataKuliah->id)->first();
        if ($checkMatKul) {
            return redirect()->back()->withErrors('Mata Kuliah sedang terpakai')->withInput();
        }
        else {
            $mataKuliah->delete();
            return redirect(route('mk-index'));
        }
    }

}
