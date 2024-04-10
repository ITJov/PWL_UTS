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
                    <br>
                @endif
                <form method="post" action="{{route('pole-store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="semester"
                                   placeholder="Masukan semester"
                                   required name="semester" maxlength="2" >
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="datetime-local" class="form-control" id="tanggal_mulai"
                                   required name="tanggal_mulai">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Akhir</label>
                            <input type="datetime-local" class="form-control" id="tanggal_selesai"
                                   required name="tanggal_selesai">
                        </div>

                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection
