<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Poling;
use App\Models\PollingDetail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class pollingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(Auth::user());
        $data = PollingDetail::all();
        return view('detailPolling.index', [
            'poleDetails' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        foreach(PollingDetail::all()as $dataPolling){
            if($dataPolling['user_id'] == Auth::user()->id){
                return  back()->with([
                    'message' => 'Anda sudah melakukan poling',
                ]);
            }

        }
        $checker = false;
        $dataPole=Poling::all();

        foreach ($dataPole as $data){
            if($data['periode'] == Auth::user()->kurikulum) {
                $tanggalMulai = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d h:i:s');
                if(Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s') >= $tanggalMulai){
                    $tanggalSelesai= Carbon::parse($data['tanggal_selesai'])->format('Y-m-d h:i:s');
                    if(Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s') <= $tanggalSelesai){
                        $checker = true;
                    }
                }
            }
        }

        if($checker){
            return view('detailPolling.create', [
                'mks' => MataKuliah::all(),
                'pole'=>Poling::all(),
            ]);
        }else{
            return  back()->with([
                'message' => 'Sesi tidak ada, silahkan hubungi admin',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = validator($request->all(), [
            'mk'=>'required',
        ], [
            'mk.required'=>'Mata Kuliah belum dipilih'
        ])->validate();

        $polling=(DB::table('polling')
            ->select('id')
            ->where('periode', Auth::user()->kurikulum)
            ->first());

        $id = IdGenerator::generate(['table' => 'polling_date','length' => 10,'prefix' =>'PD-']);

        $sks = 0;
        foreach ($request->mk as $data) {
            $sksData = DB::table('mata_kuliah')->select('sks')->where('id', $data)->first();
            if ($sksData) {
                $sks += $sksData->sks;
            }
        }
//        dd($validateData);
        if($sks <= 9){
            foreach ($validateData['mk'] as $data){
                $poleDetail = new PollingDetail();
                $poleDetail->id= $id;
                $poleDetail->polling_id = $polling->id;
                $poleDetail->user_id=Auth::user()->id;
                $poleDetail->mata_kuliah_id =$data;
                $poleDetail -> save();
            }
        }else{
            return redirect()->back()->withErrors('Jumlah SKS tidak boleh lebih dari 9 SKS')->withInput();
        }


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
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PollingDetail $pollingDetail)
    {
        $validateData = validator($request->all(), [
            'id'=>'required',
            'mk'=>'required',
        ], [
            'mk.required'=>'Mata Kuliah belum dipilih'
        ])->validate();

        $this->destroy($pollingDetail);

        $polling=(DB::table('polling')
            ->select('id')
            ->where('periode', Auth::user()->kurikulum)
            ->first());

        $sks = 0;
        foreach ($request->mk as $data) {
            $sksData = DB::table('mata_kuliah')->select('sks')->where('id', $data)->first();
            if ($sksData) {
                $sks += $sksData->sks;
            }
        }

        $this->destroy($pollingDetail);

        if($sks <= 9){
            foreach ($validateData['mk'] as $data){
                $poleDetail = new PollingDetail();
                $poleDetail->id= $validateData['id'];
                $poleDetail->polling_id = $polling->id;
                $poleDetail->user_id=Auth::user()->id;
                $poleDetail->mata_kuliah_id =$data;
                $poleDetail -> save();
            }
        }else{
            return redirect()->back()->withErrors('Jumlah SKS tidak boleh lebih dari 9 SKS')->withInput();
        }

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
