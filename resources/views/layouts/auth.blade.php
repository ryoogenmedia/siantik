@extends('layouts.base')

@section('title', $title)

@section('content')
    <div class="signin-area pb-30">
        <div class="tf-container">
            <div class="d-flex justify-content-center mt-5">
                <img style="width: 5em" src="{{ asset('logo/tik-polri-logo.png') }}" alt="tik-polri">
            </div>
            <h6 class="mt-20 text-center">Masuk Ke Aplikasi</h6>

            {{ $slot }}

        </div>
    </div>
@endsection
