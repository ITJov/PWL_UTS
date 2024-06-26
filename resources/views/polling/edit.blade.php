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
                        <br>
                    </div>
                    <br>
                @endif
                <form method="post" action="{{route('pole-update', ['polling' => $pole->id])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="idPolling">ID Polling</label>
                            <input type="text" class="form-control" id="idPolling"
                                   placeholder="ID Polling" name="id" value="{{ value($pole->id)}}"
                                   readonly autofocus maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="datetime-local" class="form-control" id="tanggal_mulai"
                                   required name="tanggal_mulai" value="{{value($pole->tanggal_mulai)}}">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Akhir</label>
                            <input type="datetime-local" class="form-control" id="tanggal_selesai"
                                   required name="tanggal_selesai" value="{{value($pole->tanggal_selesai)}}">
                        </div>
                        <div class="form-group">
                            <label for="status">Periode</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ $pole->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $pole->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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
