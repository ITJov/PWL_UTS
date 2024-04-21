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
                <form method="post" action="{{route('poleDetail-update', ['pollingDetail' => $poleDetail->id])}}">
                    @csrf
                    <div class="form-group">
                        <label for="idPoleDetail">ID</label>
                        <input type="text" class="form-control" id="idPoleDetail"
                               name="id" value="{{value($poleDetail->id) }}"
                               readonly autofocus maxlength="10">
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
{{--                        <input type="checkbox" id="mata_kuliah_id" name="mk[]"--}}
{{--                               value="{{$mk->id}}">--}}
                            @foreach($mks as $mk)
                                <tr>
                                    <td>
                                        @php $isChecked = false; @endphp
                                        @foreach(\App\Models\PollingDetail::all() as $detail)
                                            @if($detail->mata_kuliah_id == $mk->id)
                                                @php $isChecked = true; break; @endphp
                                            @endif
                                        @endforeach
                                        <input type="checkbox" id="mata_kuliah_id" name="mk[]" value="{{$mk->id}}" {{$isChecked ? 'checked' : ''}}>
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
