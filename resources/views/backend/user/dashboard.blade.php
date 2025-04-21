@extends('backend.user.layouts.app', ['page_slug' => 'dashboard'])
@section('title', 'User Dashboard')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="fs-2 fw-bold text-center">User Dashboard</h1>
            <p class="mt-4 text-center">Welcome to your dashboard, {{ user()->name }}!</p>
        </div>
    </div>
@endsection
