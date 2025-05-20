@extends('admin.layouts.app')

@section('title')
    Users
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')

        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white">
                        <h3 class="mt-2">Users ({{ $users->count() }})</h3>
                    </div>

                    <hr>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Registered</th>
                                <td class="text-end">Actions</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="text-start">{{ $key += 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <img
                                            src="{{ $user->image_path }}"
                                            alt="{{ $user->name }}"
                                            class="rounded object-fit-cover"
                                            width="60"
                                            height="60"
                                        />
                                    </td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-danger"
                                           onclick="deleteItem({{ $user->id }})">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <form id="{{ $user->id }}"
                                              action="{{ route('admin.users.destroy', $user->id) }}"
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
