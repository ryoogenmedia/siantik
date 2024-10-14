@extends('layouts.base')

@section('title', $title)

@section('content')
    <div>
        {{-- <x-loader /> --}}
        <x-header />

        <div class="app-content style-3">
            <x-backend.content :page-title="$pageTitle" :page-pretitle="$pagePretitle" />

            <x-slot name="button">
                {{ $button ?? '' }}
            </x-slot>

            {{ $slot }}
        </div>

        <x-footer />
        <x-sidebar />
    </div>
@endsection
