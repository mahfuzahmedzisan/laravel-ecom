@extends('frontend.layouts.app', ['page_slug' => 'dashboard'])
@section('title', 'User Dashboard')
@section('content')
    <div class="container mx-auto mt-10 h-[500px]  flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-3xl font-bold">User Dashboard</h1>
            <p>Welcome to your dashboard, {{ user()->name }}!</p>
        </div>
    </div>
@endsection
