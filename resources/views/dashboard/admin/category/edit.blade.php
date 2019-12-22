@extends('admin_template')

@section('content')
<!-- form start -->
<form role="form" action="{{ route('categories.update', ['category' => $Category->id]) }}" method="POST" enctype="multipart/form-data">
    @method("PATCH")
    @csrf
    @include('dashboard.admin.category.form')
</form>
@endsection