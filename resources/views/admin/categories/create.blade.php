@extends('admin.components.main')
@section('content')
    <div class="card p-4">
        <a href="{{ route('admin.categories.index') }}" class="d-flex align-items-center gap-1">
            <i class="ri-arrow-left-line"></i> Back
        </a>
        <div class="row py-5">
            <div class="col-md-6 offset-md-3">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    
                    <h3 class="text-center">Create New Category</h3>
                    @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    <div class="from-group">
                        <label for="">Category Name</label>
                        <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                    </div>
                    @if ($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                    @endif
                    <div class="form-group mt-3">
                        <button type="submit" class="btn d-block w-100 btn-sm btn-primary">CREATE</button>
                    </div>
                </form>
            </div>
        </div>
      
    </div>
@endsection