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
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{implode('',$errors->all(':message'))}}
                    </div>
                @endif
                <form method="post" action="{{route('kurikulum-update', ['kurikulum' => $kurikulums->id])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="idKurikulum">ID</label>
                            <input type="text" class="form-control" id="idKurikulum" placeholder="Id Kurikulum" name="id"
                                   value="{{ value($kurikulums->id) }}"
                                   readonly autofocus maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="namaPeriode">Periode</label>
                            <input type="text" maxlength="4" class="form-control" id="namaPeriode" placeholder="####"
                                   value="{{ value($kurikulums->periode) }}"
                                   required name="periode">
                        </div>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
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
