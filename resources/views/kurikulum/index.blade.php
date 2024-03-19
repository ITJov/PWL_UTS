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
                <div>
                    <a href="/kurikulum-create" class="btn btn-primary">Masukan Kurikulum</a>
                </div>
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
