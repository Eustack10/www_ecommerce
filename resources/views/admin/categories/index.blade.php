@extends('admin.components.main')
@section('content')
    @include('admin.categories.delete')

    <div class="card p-4">
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm d-flex justify-content-center gap-1">
               <i class="ri-add-line"></i>
               New Category
            </a>
        </div>
        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($data as $index=>$d)
               <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-danger">
                            <i class="ri-pencil-fill"></i>
                        </a>
                        <button onclick="deleteCat({{ $d->id }})" data-bs-target='#deleteModal' data-bs-toggle="modal" href="" class="btn btn-sm btn-dark">
                            <i class="ri-delete-bin-fill"></i>
                        </button>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
    <script>
        function deleteCat(id){
            document.querySelector('#delForm').action = `{{ route('admin.categories.index') }}` + `/${id}`;
        }
    </script>
@endsection