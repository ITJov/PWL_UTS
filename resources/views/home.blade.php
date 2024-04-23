@extends('layouts.master')

@section('web-content')
    <!-- Content Header (Page Header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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
    <!-- Content area -->
    <div class="container bg-gradient-white shadow">
        <!-- Page heading -->
        <h2 class="text-2xl font-semibold mb-4 mt-4 p-4">Dashboard</h2>
        <!-- Dashboard content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="image d-flex justify-content-center mb-5">
                <img src="https://blog-static.mamikos.com/wp-content/uploads/2018/12/Maranatha-Univ.jpg">
            </div>

            <!-- Card 3: Notifications -->
            <div class="bg-gray shadow p-2 m-5 rounded text-center">
                <h3 class="text-lg font-semibold mb-2">Visi</h3>
                <p>Mengembangkan cendekiawan yang andal, suasana yang kondusif,
                    dan nilai-nilai hidup kristiani sebagai upaya pengembangan ilmu pengetahuan, teknologi,
                    dan seni dalam penyelenggaraan tridarma perguruan tinggi.</p>
            </div>

            <!-- Card 4: Achievements -->
            <div class="bg-gray shadow p-2 m-5 rounded text-center">
                <h3 class="text-lg font-semibold mb-2">Misi</h3>
                <p class="text-gray-600">Mengembangkan cendekiawan yang andal,
                    suasana yang kondusif, dan nilai-nilai hidup kristiani sebagai upaya pengembangan ilmu pengetahuan,
                    teknologi, dan seni dalam penyelenggaraan tridarma perguruan tinggi.</p>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- /.content -->
@endsection

@section('spc-css')

@endsection

@section('spc-js')

@endsection
