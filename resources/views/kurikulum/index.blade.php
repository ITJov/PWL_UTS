@extends('layouts.master')

@section('web-content')
    <!-- Content Header (Page Header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Starter Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
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
{{--                @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                <div>
                    <a href="/kurikulum-create" class="btn btn-primary">Masukan Kurikulum</a>
                </div>
{{--                @endif--}}
                <h5 class="card-title">Kurikulum yang digunakan</h5>
                <table id="table-role" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Periode</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kurikulums as $kurikulum)
                        <tr>
                            <td>{{$kurikulum->id}}</td>
                            <td>{{$kurikulum->periode}}</td>
{{--                            @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                            <td>
                                <a href="{{ route('kurikulum-edit', ['kurikulum' =>$kurikulum->id]) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></button></a>
                                <a href="{{ route('kurikulum-delete', ['kurikulum' =>$kurikulum->id]) }}" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true">Delete</i></button></a>
                            </td>
{{--                            @endif--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('spc-css')

@endsection

@section('spc-js')

@endsection
