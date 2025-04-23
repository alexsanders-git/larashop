@extends('admin.layouts.app')

@section('title')
    Sizes
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')

        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Sizes ({{ $sizes->count() }})</h3>
                        <a href="{{ route('admin.sizes.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>

                    <hr>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-start">#</td>
                                    <td>Name</td>
                                    <td class="text-end">Actions</td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sizes as $key => $size)
                                    <tr>
                                        <td class="text-start">{{ $key += 1 }}</td>
                                        <td>{{ $size->name }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.sizes.edit', $size->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteItem({{ $size->id }})">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="{{ $size->id }}" action="{{ route('admin.sizes.destroy', $size->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection