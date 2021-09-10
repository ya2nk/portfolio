@extends('admin.layout.base')

@section('head-title')
<title>Edit Portfolio</title>
@endsection

@section('breadcrumb')
<a class="breadcrumb-item" href="{{ route('portfolio.index') }}"><span>Portfolio</span></a>
<li class="breadcrumb-item active" aria-current="page"><span>Edit {{ $portfolio->title }}</span></li>
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget widget-content-area br-4">
            <div class="widget-one">
                <form action="{{ route('portfolio.update', Crypt::encryptString($portfolio->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">


                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                <label for="title">TITLE</label>
                                <input id="title" type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title',$portfolio->title) }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_id">CATEGORY</label>
                                <select class="placeholder js-states form-control" name="category_id" id="category_id">
                                    @foreach ($category as $c)
                                    @if ($c->id == $portfolio->category_id)
                                    <option value={{ $c->id }} selected='selected'> {{ $c->title }} </option>
                                    @else
                                    <option value=" {{ $c->id }} "> {{ $c->title }} </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">DESCRIPTION</label>
                                <textarea id="kontenku" name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="4">{{ old('description', $portfolio->description) }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="image">IMAGE</label>
                                <div>
                                    <img id="imageview" src="{{ asset('upload/portfolio/'. $portfolio->image) }}"
                                        alt="your image" width="200px" class="rounded">
                                </div>
                                <input type="file" id="imgInp" name="image"
                                    class="form-control-file mt-4 @error('image') is-invalid @enderror"
                                    accept="image/*">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary px-5 float-right btn-sm">Save</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endpush

@push('js-internal')
<script src="{{ asset('admin/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/custom-select2.js') }}"></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endpush

@push('js-external')
<script>
    $(function () {


        $("#kontenku").each(function() {
            $(this).removeAttr("id");
                $(this).attr("id", "kontenku");
                CKEDITOR.replace('kontenku', {
                    'extraPlugins': 'imgbrowse', 
                    'filebrowserImageBrowseUrl': '{{ asset('vendor/ckeditor/plugins/imgbrowse/imgbrowse.html') }}',
                    'filebrowserImageUploadUrl': '{{ route('upload', ['_token' => csrf_token() ])}}',
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imageview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
         readURL(this);
        });


    });        
</script>
@endpush