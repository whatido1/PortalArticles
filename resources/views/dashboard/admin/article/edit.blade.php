@extends('admin_template')

@section('content')
<!-- form start -->
<form role="form" action="{{ route('articles.update', ['article' => $Article->slug]) }}" method="POST" enctype="multipart/form-data">
    @method("PATCH")
    @csrf
    @include('dashboard.admin.article.form')
</form>
@endsection