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
    <div class="content">
        <div class="container-fluid">
            <div class="card p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{implode('',$errors->all(':message'))}}
                    </div>
                @endif
                <form method="post" action="{{route('mk-store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namaMatKul">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" id="namaMatKul"
                                   placeholder="Nama Mata Kuliah"
                                   required name="nama_mata_kuliah" maxlength="40" >
                        </div>
                        <div class="form-group">
                            <label for="sks">Jumlah SKS</label>
                            <input type="text" class="form-control" id="sks"
                                   placeholder="##"
                                   required name="sks" maxlength="1" >
                        </div>
                        <div class="form-group">
                            <label for="idKurikulum">Kurikulum</label>
                            <select class="form-control" id="id-Kurikulum" name="kurikulum_id"  required>
                                <option value="" disabled selected>Select your option</option>
                                @foreach($mk as $kurikulum)
                                    <option value="{{ $kurikulum->id }}">{{ $kurikulum->id }}
                                        - {{ $kurikulum->periode }}</option>
                                @endforeach
                            </select>

                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection
