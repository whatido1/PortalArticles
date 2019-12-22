@extends('admin_template')

@section('content')
<!-- form start -->
<form role="form" action="{{ Route('admin.user.store') }}" method="POST">
    @csrf
    @include('dashboard.admin.user.form')
</form>
@endsection