<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="textName">Name</label>
                    <input type="text" class="form-control" value="{{ old('name', (isset($User)? $User->name : '')) }}" placeholder="Add Name" name="name" id="textName">
                </div>
                <div class="form-group">
                    <label for="textEmail">Email</label>
                    <input type="text" class="form-control" value="{{ old('email', (isset($User)? $User->email : '')) }}" placeholder="halo@email.com" name="email" id="textEmail">
                </div>
                <div class="form-group">
                    <label for="textPassword">Password</label>
                    <input type="password" class="form-control" value="" placeholder="Password" name="password" id="textPassword">
                </div>
                <div class="form-group">
                    <label for="textRePassword">Re-Password</label>
                    <input type="password" class="form-control" value="" placeholder="Password" name="repassword" id="textRePassword">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectRole">Role</label>
                            <select name="role" id="selectRole" class="form-control">
                                <option disabled {{ old('role') || isset($User) ? '' : 'selected' }}>-Pilih Role-</option>
                                @foreach($Roles as $role)
                                <option value="{{ $role->id }}" {{ old('role', (isset($User)? $User->role_id : '')) == $role->id ? 'selected' : ''  }}>{{$role->role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                @isset($User)
                <a href="{{ route('admin.user.index') }}" class="btn btn-warning">Cancel</a>
                @endisset
            </div>
        </div>
    </div>
</div>