<?php

namespace App\Http\Controllers;

use App\Models\kurikulum;
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
//        dd(Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s'));
        $data = PollingDetail::all();
        return view('detailPolling.index', [
            'poleDetails' => $data,
            'kurikulums'=>kurikulum::all(),
            'mks' => MataKuliah::all(),
        ]);
    }

    public function indexProdi()
    {
        $data = PollingDetail::all();
        return view('detailPolling.indexProdi', [
            'poleDetails' => $data,
            'kurikulums'=>kurikulum::all(),
            'mks' => MataKuliah::all(),
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
            }else{
            }
        }

        $checker = false;

        foreach (Poling::all() as $data){
            if($data['status'] ==  1){
                $tanggalMulai = Carbon::createFromFormat('Y-m-d H:i:s', $data['tanggal_mulai'], 'Asia/Jakarta');
                if(Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s') >= $tanggalMulai){
                    $tanggalSelesai= Carbon::createFromFormat('Y-m-d H:i:s', $data['tanggal_selesai'], 'Asia/Jakarta');
                    if(Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s') <= $tanggalSelesai){
                        $checker = true;
                    }
                }
            }
        }

        if($checker){
            return view('detailPolling.create', [
                'mks' => MataKuliah::all(),
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
            ->whereDate('tanggal_mulai', '<=', Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s')) // Memilih polling dengan tanggal_mulai kurang dari atau sama dengan tanggal saat ini
            ->whereDate('tanggal_selesai', '>=', Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d h:i:s')) // Memilih polling dengan tanggal_selesai lebih besar dari atau sama dengan tanggal saat ini
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
        if (!$pollingDetail) {
            return redirect()->back()->withErrors('Polling detail tidak ditemukan')->withInput();
        }

        $pollingId = $pollingDetail->polling_id;

        $validateData = validator($request->all(), [
            'id' => 'required',
            'mk' => 'required|array',
        ], [
            'mk.required' => 'Mata Kuliah belum dipilih'
        ])->validate();


        $sks = 0;
        foreach ($request->mk as $data) {
            $sksData = DB::table('mata_kuliah')->select('sks')->where('id', $data)->first();
            if ($sksData) {
                $sks += $sksData->sks;
            }
        }

        DB::table('polling_date')->where('id', $validateData['id'])->delete();

        if ($sks <= 9) {
            // Simpan polling detail
            foreach ($validateData['mk'] as $data) {
                $PollingDetail = new PollingDetail();
                $PollingDetail->id = $validateData['id'];
                $PollingDetail->polling_id = $pollingId;
                $PollingDetail->user_id = Auth::user()->id;
                $PollingDetail->mata_kuliah_id = $data;
                $PollingDetail->save();
            }
        } else {

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
