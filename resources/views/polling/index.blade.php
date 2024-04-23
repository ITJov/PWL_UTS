@extends('layouts.master')

@section('web-content')
    <!-- Content Header (Page Header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

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
{{--                @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                <div>
                    <a href="/pole-create" class="btn btn-primary">Masukan Polling</a>
                </div>
{{--                @endif--}}
                <h5 class="card-title">Rentang Polling</h5>
                <table id="table-role" class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($poles as $pole)
                        <tr>
                            <td>{{$pole->id}}</td>
{{--                            <td>{{$pole->semester}}</td>--}}
                            <td>{{date('d-m-Y H:i:s', strtotime($pole->tanggal_mulai))}}</td>
                            <td>{{date('d-m-Y H:i:s', strtotime($pole->tanggal_selesai))}}</td>
                            <td>{{$pole->status}}</td>
{{--                            @if(Auth::user()->namaRole->nama_role=='Admin')--}}
                            <td>
                                <a href="{{ route('pole-edit', ['polling' =>$pole->id]) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></button></a>
                                <a id="deleteData"  href="{{ route('pole-delete', ['polling' =>$pole->id]) }}" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true">Delete</i></button></a>
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
