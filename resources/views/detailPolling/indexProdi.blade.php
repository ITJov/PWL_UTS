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
                    @foreach($kurikulums as $kurikulum)
                        <h1 class="text-blue">Periode {{DB::table('kurikulum')->select('periode')->where('id',$kurikulum['id'])->first()->periode}}</h1>
                        @foreach($mks as $mk)
                            @if($mk->kurikulum_id == $kurikulum['id'])
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title p-3 mb-0 bg-primary text-white rounded-pill">{{$mk->nama_mata_kuliah}} ({{$mk->sks}} SKS)</h3>
                                        <table class="table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                            </tr>
                                            </thead>
                                        @foreach($poleDetails as $poleDetail)
                                            @if($poleDetail->mata_kuliah_id == $mk['id'])
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$poleDetail->id}}</td>
                                                        <td>{{$poleDetail->namaUser->name}}</td>
                                                    </tr>
                                                    </tbody>

                                            @endif
                                        @endforeach
                                        </table>
                                        <p class="card-text mt-3 bg-light p-2">Total: {{DB::table('polling_date')->where('mata_kuliah_id',$mk->id)->count()}} orang</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('spc-css')

@endsection

@section('spc-js')

@endsection
