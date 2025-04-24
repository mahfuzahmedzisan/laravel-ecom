@extends('frontend.layouts.app', ['page_slug' => 'dashboard'])
@section('title', 'User Dashboard')
@section('content')
    <div class="container mx-auto mt-10 h-[500px]  flex justify-center items-center">
        <div class="text-center">
            <h1 class="text-3xl font-bold">User Dashboard</h1>
            <p>Welcome to your dashboard, {{ user()->name }}!</p>
            <a href="javascript:void(0)" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
@endsection
