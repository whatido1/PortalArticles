@extends('admin_template')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">Add New</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Role</th>
                    <th>Update Date</th>
                    <th>Create Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Users as $User)
                <tr>
                    <td>{{ $User->name }}</td>
                    <td>{{ $User->email }}</td>
                    <td>{{ $User->updated_at }}</td>
                    <td>{{ $User->role->role }}</td>
                    <td>{{ $User->updated_at }}</td>
                    <td>{{ $User->created_at }}</td>
                    <td>
                        <div class="input-group">
                            <a href="{{ route('admin.user.show', ['user' => $User->id]) }}"
                                class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.user.edit', ['user' => $User->id]) }}"
                                class="btn btn-sm btn-success"><i class="fa fa-pen"></i></a>
                            <form class="formDelete" action="{{ route('admin.user.destroy', [$User->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<div class="d-flex justify-content-end">
    {{ $Users->links() }}
</div>

<div class="modal fade" id="modalDestroy" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('articles.destroy', ['article'])}}"></form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection