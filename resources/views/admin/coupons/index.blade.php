@extends('admin.layouts.app')

@section('title')
    Coupons
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')

        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Coupons ({{ $coupons->count() }})</h3>
                        <a href="{{ route('admin.coupons.create') }}" class="btn btn-sm btn-primary">
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
                                <td>Discount</td>
                                <td>Validity</td>
                                <td class="text-end">Actions</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($coupons as $key => $coupon)
                                <tr>
                                    <td class="text-start">{{ $key += 1 }}</td>
                                    <td>{{ $coupon->name }}</td>
                                    <td>{{ $coupon->discount }}%</td>
                                    <td>
                                        @if($coupon->checkIfValid())
                                            <span class="bg-success border border-dark p-1 text-white">
                                                Valid until {{ \Carbon\Carbon::parse($coupon->valid_until)->diffForHumans() }}
                                            </span>
                                        @else
                                            <span class="bg-danger border border-dark p-1 text-white">
                                                Expired
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-sm btn-danger"
                                           onclick="deleteItem({{ $coupon->id }})">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <form id="{{ $coupon->id }}"
                                              action="{{ route('admin.coupons.destroy', $coupon->id) }}"
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
