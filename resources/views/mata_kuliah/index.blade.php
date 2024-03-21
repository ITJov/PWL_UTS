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
                                        <a href="{{ route('mk-delete', ['mataKuliah' =>$item->kode_mata_kuliah]) }}" title="Delete"><button class="btn btn-danger btn-sm btn-delete"><i class="fa fa-trash" aria-hidden="true">Delete</i></button></a>
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

@section('spc-css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('spc-js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/datatables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#table-item').DataTable();

            $('.btn-delete').on('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(this).attr('href');
                    }
                });
            });
        });
    </script>

@endsection
