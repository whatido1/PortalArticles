@extends('layouts.app')
@section('content')
<div class="container py-4 mt-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{-- Please check the form below for errors --}}
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', [$User->id]) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset($User->photo) }}" class="img-circle" style="max-width: 200px; width: 100%; border-radius:50%;" alt="">
                        @isset($edit)
                        <div class="input-group mt-3">
                            <div class="custom-file">
                                <input type="file" id="filephoto"
                                    value="{{ old('photo', isset($Article)? public_path($Article->featured_image) : '') }}"
                                    class="custom-file-input fileUpload" name="photo">
                                <label class="custom-file-label overflow-hidden" for="filephoto">
                                    {{ old('photo') ? old('photo') : isset($Article)? $Article->featured_image : 'Pilih photo' }}
                                </label>
                            </div>
                        </div>
                        @endisset
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" {{ !isset($edit)? 'disabled' : ''}} value="{{$User->name}}"
                                class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" {{ !isset($edit)? 'disabled' : ''}} value="{{$User->email}}"
                                class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <input type="text" disabled value="{{$User->role->role}}" class="form-control">
                        </div>
                        @if(!isset($edit))
                        <div class="form-group">
                            <a href="{{ route('user.edit', [$User->id]) }}" class="btn btn-primary"> Edit</a>
                        </div>
                        @elseif(isset($edit))

                        @if( !is_null(Auth::user()->password) )
                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="oldpassword" class="form-control">
                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="newpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Re-new Password</label>
                            <input type="password" name="renewpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('user.show', [$User->id]) }}" class="btn btn-warning">Cancel</a>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection