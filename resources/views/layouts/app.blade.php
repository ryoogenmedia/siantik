@extends('layouts.base')

@section('title', $title)

@section('content')
    <div>
        {{-- <x-loader /> --}}
        <x-header />

        <div class="app-content style-3">
            <x-backend.content :page-title="$pageTitle" :page-pretitle="$pagePretitle" :button="$button ?? null" />

            <div class="line4-bt pt-16 pb-16 mb-5">
                <div class="tf-container mb-5">
                    {{ $slot }}
                </div>
            </div>
        </div>

        {{-- <x-footer /> --}}
        <x-sidebar />
    </div>
@endsection
