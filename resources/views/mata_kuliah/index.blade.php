@extends('mata_kuliah.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Polling Mata Kuliah Semester Antara</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('mk-create') }}" class="btn btn-success btn-sm" title="Add Mata Kuliah">
                            Add mata kuliah
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Kode Mata Kuliah</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Kurikulum_id</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mk as $item)
                                <tr>
                                    <td>{{ $item->kode_mata_kuliah }}</td>
                                    <td>{{ $item->nama_mata_kuliah }}</td>
                                    <td>{{ $item->sks }}</td>
                                    <td>{{ $item->kurikulum_id }}</td>

                                    <td>
                                        <a href="{{ route('mk-edit', ['mataKuliah' =>$item->kode_mata_kuliah]) }}" title="Edit"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true">Edit</i></button></a>
                                        <a href="{{ route('mk-delete', ['mataKuliah' =>$item->kode_mata_kuliah]) }}" title="Delete"><button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true">Delete</i></button></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection