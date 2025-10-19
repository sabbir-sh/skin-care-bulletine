@extends('frontend.layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-3">{{ $blog->title }}</h2>

    @if($blog->featured_image)
        <img src="{{ asset($blog->featured_image) }}" class="img-fluid mb-3" alt="{{ $blog->title }}">
    @endif

    <div class="text-justify" style="text-align: justify; text-justify: inter-word;">
        {!! $blog->content !!}
    </div>
</div>

@endsection
