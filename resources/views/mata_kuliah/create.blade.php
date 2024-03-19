@extends('mata_kuliah.layout')
@section('content')

    <!-- Main content -->
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
                            <label for="kodeMatKul">ID</label>
                            <input type="text" class="form-control" id="kodeMatKul"
                                   placeholder="Kode Mata Kuliah" name="kode_mata_kuliah"
                                   required autofocus maxlength="10">
                        </div>
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
                                   required name="sks" maxlength="2" >
                        </div>
                        <div class="form-group">
                            <label for="idKurikulum">Kurikulum</label>
                            <select class="form-control" id="id-Kurikulum" name="kurikulum_id" required>
                                <option>Testing</option>
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
