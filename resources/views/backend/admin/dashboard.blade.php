@extends('backend.admin.layouts.app')
@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-center">Admin Dashboard</h1>
        <p class="mt-4 text-center">Welcome to your dashboard, {{ auth('admin')->user()->name }}!</p>
    </div>
@endsection
