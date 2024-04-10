<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Poling;
use App\Models\PollingDetail;
use App\Http\Controllers\Controller;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class pollingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PollingDetail::all();
        return view('detailPolling.index', [
            'poleDetails' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('detailPolling.create', [
            'mks' => MataKuliah::all(),
            'poles' => Poling::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $validateData = validator($request->all(),[
            'polling_id'=>'required|string',
        ],[
            'polling_id.required'=>'Semester belum dipilih,silahkan pilih',
        ])-> validate();

        $poleDetail = new PollingDetail($validateData);
        $poleDetail->id= IdGenerator::generate(['table' => 'polling_date','length' => 10,'prefix' =>'PD-']);
        $poleDetail->user_id=Auth::user()->id;
        $poleDetail->mata_kuliah_id = json_encode($request->mk);
        $poleDetail -> save();

        return redirect(route('poleDetail-index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PollingDetail $pollingDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PollingDetail $pollingDetail)
    {
        return view('detailPolling.edit' , [
            'poleDetail' => $pollingDetail,
            'mks' => MataKuliah::all(),
            'poles' => Poling::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PollingDetail $pollingDetail)
    {
        $validateData = validator($request->all(),[
            'polling_id'=>'required|string',
        ],[
            'polling_id.required'=>'Semester belum dipilih,silahkan pilih',
        ])-> validate();

        $pollingDetail->id= $request->id;
        $pollingDetail->polling_id= $request->polling_id;
        $pollingDetail->user_id= Auth::user()->id;
        $pollingDetail->mata_kuliah_id = json_encode($request->mk);
        $pollingDetail -> save();
        return redirect(route('poleDetail-index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PollingDetail $pollingDetail)
    {
        $pollingDetail->delete();
        return redirect(route('poleDetail-index'));
    }
}
