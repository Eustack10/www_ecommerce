@extends('admin.components.main')
@section('content')
    <div class="card p-4">
        @if ($catCount > 0)
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm d-flex justify-content-center gap-1">
               <i class="ri-add-line"></i>
                New Products
            </a>
        </div>

        <table class="table table-borderless table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Varitants</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($data as $index=>$d)
               <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->brand }}</td>
                    <td>{{ $d->categories->name }}</td>
                    <td>
                        <div class="d-flex flex-column align-items-start gap-1">
                            @foreach ($d->products_variants as $pv)
                                <span class="badge bg-primary">
                                    {{ $pv->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td>{{ $d->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $d->id) }}" class="btn btn-sm btn-danger">
                            <i class="ri-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $d->id) }}" method="post">
                            @csrf {{method_field('delete')}}
                            <button type="submit" href="" class="btn btn-sm btn-dark">
                                <i class="ri-delete-bin-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>

        @if ($data->hasPages())
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a href="{{ $data->previousPageUrl() }}" class="page-link">Prev</a>
                </li>
                @php
                    $val = ceil($data->total() / $data->perPage());
                @endphp
                @for ($i = 1; $i <= $val; $i++)
                   <li class="page-item {{ $data->currentPage() == $i ? 'active' : '' }}">
                        <a href="{{ $data->url($i) }}" class="page-link">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item">
                    <a href="{{ $data->nextPageUrl() }}" class="page-link">Next</a>
                </li>
            </ul>
        @endif
        @else
            <p class="py-5 text-center">Pleas create category first.</p>
        @endif
    </div>
@endsection