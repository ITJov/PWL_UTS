@extends('layouts.master')

@section('web-content')
    <!-- Content Header (Page Header) -->
    <x-guest-layout>
        <!-- Content area -->
        <div class="container mx-auto py-16">
            <!-- Unauthorized message -->
            <div class="max-w-lg mx-auto bg-white shadow-md rounded-md p-8">
                <h2 class="text-2xl font-semibold mb-4">Unauthorized Access</h2>
                <p class="text-gray-600">Oops! You are not authorized to access this page.</p>
                <p class="text-gray-600">Please contact the administrator for further assistance.</p>
                <!-- Back button -->
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700">Back to Home</a>
                </div>
            </div>
        </div>
    </x-guest-layout>

    <!-- /.content -->
@endsection

@section('spc-css')

@endsection

@section('spc-js')

@endsection
