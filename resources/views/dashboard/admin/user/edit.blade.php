@extends('admin_template')

@section('content')
<!-- form start -->
<form role="form" action="{{ route('admin.user.update', ['user' => $User->id]) }}" method="POST" enctype="multipart/form-data">
    @method("PATCH")
    @csrf
    @include('dashboard.admin.user.form')
</form>
@endsection