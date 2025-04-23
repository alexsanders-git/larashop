@extends('admin.layouts.app')

@section('title')
    Colors
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')

        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Colors ({{ $colors->count() }})</h3>
                        <a href="{{ route('admin.colors.create') }}" class="btn btn-sm btn-primary">
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
                                @foreach ($colors as $key => $color)
                                    <tr>
                                        <td class="text-start">{{ $key += 1 }}</td>
                                        <td>{{ $color->name }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.colors.edit', $color->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm btn-danger" onclick="deleteItem({{ $color->id }})">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            <form id="{{ $color->id }}" action="{{ route('admin.colors.destroy', $color->id) }}"
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