@extends('layouts.app')

@section('content')
<div class="jumbotron d-flex align-items-center" style="background-image: url('{{ asset($Article->featured_image) }}'); background-size: cover; background-position: center; min-height: 400px;">
    <div class="container text-center">
        <h1 class="display-4">{{ $Article->title }}</h1>
    </div>
</div>
<div class="container">
    {!! $Article->content !!}
</div>
@endsection
