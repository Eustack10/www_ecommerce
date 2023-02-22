@extends('admin.components.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/image-uploader.min.css') }}">
@endsection
@section('content')
<div class="card p-4">
    <a href="{{ route('admin.products.index') }}" class="d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back
    </a>
    <div class="row">

        <div class="col-12">
            <h3 class="text-center">Edit Product</h3>
        </div>
        <div class="col-md-10 offset-md-1">
            <form action="{{ route('admin.products.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf {{ method_field('put') }}
                <div class="d-flex gap-2">
                    <div class="form-group w-100">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" placeholder="Enter product name" name="name" value="{{ $data->name }}">
                        @if ($errors->has('name'))
                            <p class="text-danger mt-1">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    
                    <div class="form-group w-100">
                        <label for="">Select Category</label>
                        <select class="form-control" name="categories_id">
                            <option disabled>--Select Category--</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $data->categories_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('categories_id'))
                            <p class="text-danger mt-1">{{ $errors->first('categories_id') }}</p>
                        @endif
                    </div>
                   
                    <div class="form-group w-100">
                        <label for="">Product Brand</label>
                        <input type="text" value="{{ $data->brand }}" class="form-control" placeholder="Enter product brand" name="brand">
                        @if ($errors->has('brand'))
                            <p class="text-danger mt-1">{{ $errors->first('brand') }}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="">Product Description</label>
                    <textarea type="text" rows="4" class="form-control" placeholder="Enter product description" name="description">{{ $data->description }}</textarea>
                </div>
                @if ($errors->has('description'))
                    <p class="text-danger mt-1">{{ $errors->first('description') }}</p>
                @endif
                <div class="form-group mt-3">
                    <label for="images">Images ( Maximum upload image number is 5 )</label>
                    <div class="input-images" id="images"></div>
                </div>
                @if ($errors->has('images'))
                    <p class="text-danger mt-1">{{ $errors->first('images') }}</p>
                @endif
                <div class="d-flex flex-wrap mt-3 align-items-center gap-3">
                   @foreach ($data->products_variants as $pv)
                    <div class="border border-gray p-3 rounded-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Variant - 1</h6>
                            <span onclick="this.parentElement.parentElement.remove()" class="fs-5 text-muted ri-close-line"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ $pv->name }}" required class="form-control" name="variant_name[]" placeholder="Variant's Name">
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" value="{{ $pv->price }}" required class="form-control" name="variant_price[]" placeholder="Variant's Price">
                        </div>
                    </div>
                   @endforeach

                    <button type="button" class="new_variant bg-transparent border-0">
                        <i class="fs-1 ri-add-circle-line text-primary"></i>
                    </button>
                </div>

                <div class="form-check form-switch mt-3">
                    <input class="form-check-input" name="is_publish" type="checkbox" id="flexSwitchCheckChecked" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Is Publish</label>
                </div>
                <button class="btn btn-primary px-5 py-1 mx-auto d-block">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/image-uploader.js') }}"></script>
    <script>
         $.ajax({
            url: `/admin/products/images/{{ $data->id }}`,     
         }).done(function(response) {
            if( response ){
            $(".input-images").imageUploader({
                preloaded: response,
                imagesInputName: 'images',
                preloadedInputName: 'old_images',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 5,
            });

        }});

    </script>
    <script>
        $(document).ready(function(){
            $('.new_variant').on('click', function(){
                $(this).before(`<div class="border border-gray p-3 rounded-2">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6>Variant - ${$(this).parent().children().length}</h6>
                            <span onclick="this.parentElement.parentElement.remove()" class="fs-5 text-muted ri-close-line"></span>
                            
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" name="variant_name[]" placeholder="Variant's Name">
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" required class="form-control" name="variant_price[]" placeholder="Variant's Price">
                        </div>
                    </div>`);
            });
            
        });
    </script>
@endsection