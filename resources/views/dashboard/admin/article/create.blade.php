@extends('admin_template')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Buat Artikel</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ Route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                @if( $errors->any() )
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada error pada form yang kamu submit <br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="textTitle">Title</label>
                    <input type="text" value="{{ old('title') }}" id="textTitle" class="form-control" placeholder="Add Title" name="title">
                </div>
                <div class="form-group">
                    <label for="textSlug">Slug</label>
                    <input type="text" value="{{ old('slug') }}" id="textSlug" class="form-control" placeholder="Add Slug" name="slug">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fileBanner">Banner</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" id="fileBanner" value="{{ old('banner') }}" class="custom-file-input" name="banner">
                                    <label class="custom-file-label" for="fileBanner">Pilih File</label>
                                </div>
                                {{-- <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ml-auto text-right">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAM1BMVEXMzMzPz8+vr6/Ly8vAwMCRkZHDw8PGxsaWlpaenp6Tk5PCwsK2trahoaG6urqsrKympqZJMGkaAAAFGElEQVR4nO2dbZfbKAyFEWAD5vX//9q9giT2ZLbT9pw2TXfv0zMuiWUfXQsJ/EUxhhBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQ8lsR8OXwi+vks/F3r3s5bRyxeqfD0OPR9/mts2mr/ovLJI94pOKejVs6YnO/1+Wfo8UtqVM6TltMW5ruWR3GLySGeMQUN/tk3CA7xvL7/f5hJB0lhLbVYKRtfQ/9KJhlOdYcylG/OeGkI9rBJ9V1MQ718MEfKbxSw9fkrRv1N+7GJXXMVQTR9W2Hv317eHpLrofikDTW4vE8LsZ4SHg+6/guLGekbFl8HDLFNgk16rBFe/M0WKtis73PvzyNTcDlF2MZh6ZxiN8O/ssJWT2XEXconE9ewxLS8n/9p6QZnPoIjlvXtY/GUuf8dCO+j0Ile3t0B29nrdCw7Ct4F4U+Hk78Nq5VMvgSkb8XY0nTwPXjrRTKdhxpx0ydM8y4zco+yw0ys96N4LR1NfqL54joceCLi7HEfqvEr5XwHVRhtA656NZHi/ozVw+p6REzH1OP48N1CRciZhdjmXXLiN3eakU04kpEHp4xNJ9jqCE+4sdFQKQl5O6/xvC9FGoB3TwkZB1f8tCdeQiw33nOLqwL9mos8f3ysLUZl7Y1lPs521Yt7U+VRpe+I51+5zKv04BfjKXWd6ulWCbWZgvrYZ6ein2sh+ZcD1VATId9XFfWuuEe6+E0njuHuR14H4VlJtH0bG1TTEVddWs3Y7dzY1pibzHt94+37UFbe5q7MYQ30XDbt1GIrEu7oFjo7NItKeaqFswWuyCo8bRLkDHOICKkTTR8/oPxHhP2dynmPyDlG2AHHee7hT50vGbUbRXMsUUM2+NtsW+YwuF4uI7oHakeK1gXY1TcGs8H8Q6EnuDrrDHGw7m6VIUBueVR88Om2qDz3HCWhBelbp6MncVblX2jVwvgQs53j8L+GLpzqJ/8PpeBfHljVGP3yRjD/d0WQ0IIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEELIm5PLefzL8N7/SI85Pxvw+aeeibOnmwu7n3eZN9p3/N3Pu331ggs+u3UKw1/o/I8g0dq+r3byZ9NrWQe5d8IWyXeFcjfRP+vnl83WYb02uDVuJJFHd8zebYeJH310MxsRO7u9uLEkvJFSpNcu0p144zDwtQcjvaTdde1EiKNdCuFqlt0iIKtbqNdumJBts2iT2iAQeyos1kkIJkCls0WqbRL6q9ufLoVwBRJKc9HkLm0YD53JGhnN9KbHOhXmtOcRTPdS7FRYMD2LKvTabLhZN8IZQ7n18fWzmWSVFIaz7dXtwOcsDXV64HrrpXmxw9oIP9fZYfUpPPJQ4+aH6bPlt1qqwVKYDDTKFwoF+syrG7xKyj7AFYEHMuw+MN+szTlrdPHncw5wHbNvKuxLDCbtvBjGM0VvCqVEfyrEtNeWrqgwmP7SOr7WxumvV7jyC/+QecPYirwZfs5S0UzypQnKRVoKYynaEdqvRqj3SvNQKDKPMaO0ShRXC8oQ7jKQnm4+Mnm5QjNXOIRIW5t6b3b1OSCK64xrtqAAFttWT/dWtIvyykIVp0K1/s9Bud0Qk8BiLuNjwIV6BncJ5/k/w8cHe/kpkqffTTCrNfR3bnb5OZRPN/wbyKn9XQ7/PP91fYT8j/gHpIIpSX4o390AAAAASUVORK5CYII=" alt="">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="selectCategory">Category</label>
                    <select class="form-control" id="selectCategory" name="category">
                        <option>-Pilih Kategori-</option>
                        @foreach($Categories as $Category)
                        <option value="{{ $Category->id }}"  {{old('category') == $Category->id ? 'selected' : ''}}>
                            {{ $Category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="textContent">Content</label>
                    <textarea name="content" class="form-control tinyMCE" id="textContent" cols="30" rows="10">{{ old('content') }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection