@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800">Ini Dashboard</h1>
        <p class="mt-2 text-gray-600">Selamat datang di Panel Admin, {{ Auth::user()->name }}!</p>
    </div>
</div>
@endsection