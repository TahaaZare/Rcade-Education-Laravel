@extends('pwa.master')
@section('title', 'درباره ما')
@section('app-menu')
    @include('pwa.app-button-menu')
@endsection
@section('header')
    @include('pwa.header')
@endsection
@section('content')
    <div class="section mt-2">
        <div class="card">
            <div class="card-header bg-success" aria-hidden="true">
                درباره مـا
            </div>
            <div class="card-body">
                {!! $about->description !!}
            </div>
        </div>
    </div>
@endsection
