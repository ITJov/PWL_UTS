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
    <div class="content">
        <div class="container-fluid">
            <div class="card p-4">
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div>
                    <a href="{{ route('mk-create') }}" class="btn btn-primary" title="Add Mata Kuliah">
                        Add mata kuliah
                    </a>
                </div>
                <h5 class="card-title">Polling Mata Kuliah</h5>
                <table id="table-role" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Kode Mata Kuliah</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Kurikulum</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mks as $mk)
                        <tr>
                            <td>{{ $mk->id}}</td>
                            <td>{{$mk->nama_mata_kuliah}}</td>
                            <td>{{ $mk->sks }}</td>
                            <td>{{ $mk->namaKurikulum->periode}}</td>
                            {{--                            @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                            <td>
                                <a href="{{ route('mk-edit', ['mataKuliah' =>$mk->id]) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></button></a>
                                <a href="{{ route('mk-delete', ['mataKuliah' =>$mk->id]) }}" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true">Delete</i></button></a>
                            </td>
                            {{--                            @endif--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection