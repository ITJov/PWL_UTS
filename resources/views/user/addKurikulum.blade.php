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
                <form method="post" action="{{route('storeKurikulum', ['pengguna' => $users->id])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="namaUser">Nama User</label>
                            <input type="text" class="form-control" id="namaUser"
                                   placeholder="Nama User" value="{{ value($users->name) }}"
                                   required disabled name="name" maxlength="40" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"
                                   placeholder="Contoh : johndoe@gmail.com" value="{{value($users->email)}}"
                                   required disabled name="email">
                        </div>
                        <div class="form-group">
                            <label for="kurikulum">Kurikulum yang digunakan</label>
                            <select class="form-control" id="kurikulum" name="kurikulum" required>
                                <option value="" disabled selected> Select your option</option>
                                @foreach($kurikulums as $kurikulum)
                                    <option value="{{ $kurikulum->id }}">Periode
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
