@extends('layouts.base')

@section('title', $title)

@section('content')
    <div class="signin-area pb-30">
        <div class="tf-container">
            <h1 class="mt-20 text-center">Login</h1>

            {{ $slot }}

        </div>
    </div>
@endsection
