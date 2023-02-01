@extends('admin.components.main')
@section('content')
<div class="card p-4">
    <a href="{{ route('admin.categories.index') }}" class="d-flex align-items-center gap-1">
        <i class="ri-arrow-left-line"></i> Back
    </a>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <form action="{{ route('admin.products.store') }}" method="POST">
                <div class="row py-5">
                    <div class="col-md-6 px-3">
                            @csrf
                            <div class="form-group">
                                <label for="">Product Name</label>
                                <input type="text" class="form-control" placeholder="Enter product name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="">Select Category</label>
                                <select class="form-control" name="categories_id">
                                    <option disabled selected>--Select Category--</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Product Brand</label>
                                <input type="text" class="form-control" placeholder="Enter product brand" name="brand">
                            </div>
                            <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea type="text" class="form-control" placeholder="Enter product description" name="description"></textarea>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Is Publish</label>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="border">
                            <input type="text" name="variant_name[]">
                            <input type="number" name="variant_price[]">
                        </div>
                        <div class="border">
                            <input type="text" name="variant_name[]">
                            <input type="number" name="variant_price[]">
                        </div>
                        <div class="border">
                            <input type="text" name="variant_name[]">
                            <input type="number" name="variant_price[]">
                        </div>
                        <div class="border">
                            <input type="text" name="variant_name[]">
                            <input type="number" name="variant_price[]">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection