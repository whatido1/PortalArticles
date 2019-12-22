@extends('admin_template')

@section('content')
<!-- form start -->
<form role="form" action="{{ Route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('dashboard.admin.article.form')
</form>
@endsection