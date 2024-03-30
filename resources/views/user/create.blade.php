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
                <form method="post" action="{{route('user-store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kodeUser">ID User</label>
                            <input type="text" class="form-control" id="kodeUser"
                                   placeholder="Kode User" name="id"
                                   required autofocus maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="namaUser">Nama User</label>
                            <input type="text" class="form-control" id="namaUser"
                                   placeholder="Nama User"
                                   required name="namaUser" maxlength="40" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"
                                   placeholder="Contoh : johndoe@gmail.com"
                                   required name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password"
                                   placeholder="Password" required name="password">
                        </div>
                        <div class="form-group">
                            <label for="idRole">Role</label>
                            <select class="form-control" id="idRole" name="role_id"  required>
                                <option value="" disabled selected> Select your option</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->id }}
                                        - {{ $role->nama_role }}</option>
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
