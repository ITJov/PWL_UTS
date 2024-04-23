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
    <div class="container">
        <!-- Page heading -->
        <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>

        <!-- Dashboard content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Courses -->
            <div class="bg-white shadow-sm rounded-md p-4">
                <h3 class="text-lg font-semibold mb-2">My Courses</h3>
                <p class="text-gray-600">You are currently enrolled in 5 courses.</p>
            </div>

            <!-- Card 2: Progress -->
            <div class="bg-white shadow-sm rounded-md p-4">
                <h3 class="text-lg font-semibold mb-2">Progress</h3>
                <p class="text-gray-600">You have completed 60% of your courses.</p>
            </div>

            <!-- Card 3: Notifications -->
            <div class="bg-white shadow-sm rounded-md p-4">
                <h3 class="text-lg font-semibold mb-2">Notifications</h3>
                <p class="text-gray-600">You have 3 new notifications.</p>
            </div>

            <!-- Card 4: Achievements -->
            <div class="bg-white shadow-sm rounded-md p-4">
                <h3 class="text-lg font-semibold mb-2">Achievements</h3>
                <p class="text-gray-600">You have earned 2 new achievements.</p>
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
