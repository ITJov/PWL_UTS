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
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{implode('',$errors->all(':message'))}}
                    </div>
                @endif
                <form method="post" action="{{route('poleDetail-update', ['pollingDetail' => $poleDetail->id])}}">
                    @csrf
                    <div class="form-group">
                        <label for="idPoleDetail">ID</label>
                        <input type="text" class="form-control" id="idPoleDetail"
                               name="id" value="{{ value($poleDetail->id) }}"
                               readonly autofocus maxlength="10">
                    </div>
                    @php
                        $mataKuliah = $poleDetail->mata_kuliah_id;
                    @endphp
                    <table id="table-role" class="table table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($mks as $mk)
                                @if(Auth::user()->kurikulum == $mk->kurikulum_id)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="mata_kuliah_id" name="mk[]"
                                               value="{{$mk->id}}" {{in_array($mk->id,$mataKuliah)?'checked':''}}>
                                    </td>
                                    <td>{{$mk->id}}</td>
                                    <td>{{$mk->nama_mata_kuliah}}</td>
                                    <td>{{$mk->sks}}</td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>

            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('spc-css')

@endsection

@section('spc-js')

@endsection
