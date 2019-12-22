<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="textName">Category Name</label>
                    <input type="text" class="form-control" value="{{ old('name', (isset($Category)? $Category->name : '')) }}" placeholder="Add Name" name="name" id="textName">
                </div>
                <div class="form-group">
                    <label for="textSlug">Slug</label>
                    <input type="text" class="form-control" value="{{ old('slug', (isset($Category)? $Category->slug : '')) }}" placeholder="Add Slug" name="slug" id="textSlug">
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Save</button>
                @isset($Category)
                <a href="{{ route('categories.index') }}" class="btn btn-warning">Cancel</a>
                @endisset
            </div>
        </div>
    </div>
</div>