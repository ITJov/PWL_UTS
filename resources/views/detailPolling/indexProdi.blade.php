@extends('layouts.master')

@section('web-content')
    <!-- Content Header (Page Header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                        <li class="breadcrumb-item active"></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card p-4">
                @if(session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
{{--                @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                <div>
                    <a href="/poleDetail-create" class="btn btn-primary">Lakukan Polling</a>
                </div>
{{--                @endif--}}
                <h5 class="card-title">Hasil Poling</h5>
                <table id="table-role" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Id Polling</th>
                        <th>Nama</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($poleDetails as $poleDetail)
                        @if($poleDetail->user_id == Auth::user()->id)
                            <tr>
                                <td>{{$poleDetail->id}}</td>
                                <td>{{$poleDetail->polling_id}}</td>
                                <td>{{$poleDetail->namaUser->name}}</td>
                                <td>{{$poleDetail->namaMatKul->nama_mata_kuliah }}</td>
                                <td>{{$poleDetail->namaMatKul->sks}}</td>
    {{--                            @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                                <td>
                                    <a href="{{ route('poleDetail-edit', ['pollingDetail' =>$poleDetail->id]) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></button></a>
                                    <a id="deleteData" href="{{ route('poleDetail-delete', ['pollingDetail' =>$poleDetail->id]) }}" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true">Delete</i></button></a>
                                </td>
    {{--                            @endif--}}
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                    @php
                        $testing = \Illuminate\Support\Facades\DB::table('role')
                                    ->select('nama_role')
                                    ->where('id',auth()->user()->role)->first();
                                $namaRole = \Illuminate\Support\Str::upper($testing->nama_role);
                    @endphp
                    @if(Auth::user()->role == 'PRODI')
                    @foreach($kurikulums as $kurikulum)
                        <h1 class="text-blue">Periode {{DB::table('kurikulum')->select('periode')->where('id',$kurikulum['id'])->first()->periode}}</h1>
                        @foreach($poleDetails as $poleDetail)
                            @if($poleDetail->namaMatKul->kurikulum_id == $kurikulum['id'])
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title p-3 mb-0 bg-primary text-white rounded-pill">{{$poleDetail->namaMatKul->nama_mata_kuliah}} ({{$poleDetail->namaMatKul->sks}} SKS)</h3>
                                        @foreach($mks as $mk)
                                            @if($poleDetail->mata_kuliah_id == $mk['id'])
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nama</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$poleDetail->id}}</td>
                                                        <td>{{$poleDetail->namaUser->name}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        @endforeach
                                        <p class="card-text mt-3 bg-light p-2">Total: {{DB::table('polling_date')->where('mata_kuliah_id',$poleDetail->mata_kuliah_id)->count()}} orang</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    @endif
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('spc-css')

@endsection

@section('spc-js')

@endsection
