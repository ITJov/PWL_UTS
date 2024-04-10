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
                <form method="post" action="{{route('poleDetail-store')}}">
                    @csrf
{{--                    <div class="form-group">--}}
{{--                        <label for="idPoling">ID</label>--}}
{{--                        <input type="text" class="form-control" id="idPoling"--}}
{{--                               placeholder="Id Polling" name="idPoling"--}}
{{--                               required autofocus maxlength="10">--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <label for="idPole">Semester yang dipilih</label>
                        <select class="form-control" id="idPole" name="polling_id"  required>
                            <option value="" disabled selected> Select your option</option>
                            @foreach($poles as $pole)
                                <option value="{{ $pole->id }}">Semester
                                    - {{ $pole->semester }}</option>
                            @endforeach
                        </select>
                    </div>
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
                                <tr>
                                    <td>
                                        <input type="checkbox" id="mata_kuliah_id" name="mk[]"
                                               value="{{$mk->id}}">
                                    </td>
                                    <td>{{$mk->id}}</td>
                                    <td>{{$mk->nama_mata_kuliah}}</td>
                                    <td>{{$mk->sks}}</td>
                                </tr>
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
