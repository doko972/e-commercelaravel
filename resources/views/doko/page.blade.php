@extends('base')

@section('title')
    {{ $page->title }} | Doko
@endsection

@section('content')

@include('doko/components/top-page', ['title'=> $page->title])

    <div class="container">
        {!! $page->content !!}
    </div>

@endsection