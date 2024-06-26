<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
use App\Models\Poling;
use App\Http\Controllers\Controller;
use App\Models\PollingDetail;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class pollingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Poling::all();
        return view('polling.index', [
            'poles' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('polling.create', [
            'pole' => Poling::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(),[
            'tanggal_mulai'=>'required',
            'tanggal_selesai'=>'required',
        ],[
            'tanggal_mulai.required'=> 'Tanggal Mulai belum diisi',
            'tanggal_selesai.required'=> 'Tanggal Akhir belum diisi',
        ])-> validate();

        $id = IdGenerator::generate(['table' => 'polling', 'length' => 10, 'prefix' =>'PL-']);

        $pole = new Poling($validateData);
        $pole->id=$id;
        $pole->status = 1;
        $pole->save();
        return redirect(route('pole-index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Poling $poling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poling $polling)
    {
        return view('polling.edit' , [
            'pole' => $polling,
            'kurikulums'=>kurikulum::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poling $polling)
    {
        $validateData = validator($request->all(), [
            'id'=>['required','max:10',Rule::unique('polling')->ignore($polling->id),],
            'tanggal_mulai'=>'required',
            'tanggal_selesai'=>'required',
            'status'=>'required'
        ], [
            'id.required' => 'ID Polling harus diisi',
            'id.unique' => 'ID sudah terdaftar, silahkan diganti dengan nomor lain',
            'tanggal_mulai.required'=> 'Tanggal Mulai belum diisi',
            'tanggal_selesai.required'=> 'Tanggal Akhir belum diisi',
            'status.required'=>'Status belum dipilih'
        ])-> validate();

        $polling->id = $validateData['id'];
        $polling->tanggal_mulai = $validateData['tanggal_mulai'];
        $polling->tanggal_selesai = $validateData['tanggal_selesai'];
        $polling->status = $validateData['status'];
        $polling->save();
        return redirect(route('pole-index'));
//        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poling $polling)
    {
        $checkPolling = PollingDetail::where('polling_id', $polling->id)->first();
        if ($checkPolling) {
            return redirect()->back()->withErrors('Periode polling sedang terpakai')->withInput();
        }
        else {
            $polling->delete();
            return redirect(route('pole-index'));
        }
    }
}
