<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="textTitle">Title</label>
                    <input type="text" value="{{ old('title', (isset($Article)? $Article->title : '') )}}" id="textTitle" class="form-control"
                        placeholder="Add Title" name="title">
                </div>
                <div class="form-group">
                    <label for="textContent">Content</label>
                    <textarea name="content" class="form-control tinyMCE" id="textContent" cols="30"
                        rows="10">{{ old('content') ? old('content') : isset($Article)? $Article->content : '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h5>Post Setting</h5></div>
            <div class="card-body">
                @if(isset($Article))
                <div class="form-group text-center">
                    <img src="{{ $Article->thumbnail }}">
                </div>
                @endif
                <div class="form-group">
                    <label for="textSlug">Slug</label>
                    {{-- {{ dd(old('slug'))}} --}}
                    <input type="text" value="{{ old('slug') ? old('slug') : isset($Article)? $Article->slug : '' }}" id="textSlug" class="form-control" placeholder="Add Slug"
                        name="slug">
                </div>
                <div class="form-group">
                    <label for="fileBanner">Banner</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="fileBanner" value="{{ old('banner') ? old('banner') : isset($Article)? public_path($Article->featured_image) : '' }}" class="custom-file-input"
                                name="banner">
                            <label class="custom-file-label overflow-hidden" for="fileBanner"> {{ old('banner') ? old('banner') : isset($Article)? $Article->featured_image : 'Pilih Banner' }} </label>
                        </div>
                        {{-- <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div> --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectCategory">Category</label>
                    <div class="input-group">
                        <select class="form-control" id="selectCategory" name="category">
                            <option disabled {{ old('category') || isset($Article) ? '' : 'selected' }}>-Pilih Kategori-</option>
                            @foreach($Categories as $Category)
                            <option value="{{ $Category->id }}" {{ old('category') && old('category') == $Category->id ? 'selected' : '' }}>
                                {{ $Category->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <a href="" class="btn btn-success"><i class="fa fa-plus"></i></a>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                @isset($Article)
                    <a href="{{ route('articles.index') }}" class="btn btn-warning">Cancel</a>
                @endisset
            </div>
        </div>
    </div>
</div>