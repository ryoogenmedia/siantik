@extends('layouts.base')

@section('title', $title)

@section('content')
    <div class="signin-area pb-30">
        <div class="tf-container">
            <div class="d-flex justify-content-center mt-5">
                <img style="width: 5em" src="{{ asset('logo/tik-polri-logo.png') }}" alt="tik-polri">
            </div>

            {{-- <h6 class="mt-20 text-center">Masuk Ke Aplikasi</h6> --}}

            @if ($errors->any())
                <div class="alert alert-warning light alert-dismissible fade show mb-10 mt-5" role="alert">
                    <x-icon.alert.warning />

                    <span>Ada yang salah!
                        @foreach ($errors->all() as $error)
                            <p> - {{ $error }}</p>
                        @endforeach
                    </span>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="icon-close"></i>
                    </button>
                </div>
            @endif

            {{ $slot }}

        </div>
    </div>
@endsection
