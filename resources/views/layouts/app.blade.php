@extends('layouts.base')

@section('title', $title)

@section('content')
    <div>
        {{-- <x-loader /> --}}
        <x-header />

        <div class="app-content style-3">
            {{ $slot }}
        </div>

        <x-footer />
        <x-sidebar />
    </div>
@endsection
