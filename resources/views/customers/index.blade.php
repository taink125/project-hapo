@extends('layouts.master')
@section('title', 'Customers')
@section('management', 'List Customers')
@section('content')
<div class="container-fluid">
<!-- SEARCH FORM -->
<form class="form-inline mb-3" method="get" action="{{ route('customer.search') }}">
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" value="{{ request()->input('keySearch') }}" name="keySearch" type="search" placeholder="Search"
            aria-label="Search">&nbsp;
        <div class="input-group-append">
            <button class="btn btn-navbar bg-success" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
<div class="w-50">
    <a href="{{ route('customer.create') }}" class="btn btn-primary bg-primary mb-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Customer</a>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
            </a> {{ session('success') }}
        </div>
    @endif
</div>
<table class="table table-bordered table-sm table-striped table-hover">
    <tr class="thead-dark">
        <th class="text-center">Name</th>
        <th class="text-center">Image</th>
        <th class="text-center">Email</th>
        <th class="text-center">Phone</th>
        <th class="text-center">Address</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach($customers as $customer)
    <tr>
        <td>{{ $customer->name }}</td>
        <td class="text-center"><img style="width: 50px; height: 50px; object-fit: contain;" src="{{ asset("storage/images/$customer->image") }}" alt="avatar"></td>
        <td>{{ $customer->email }}</td>
        <td class="text-center">{{ $customer->phone }}</td>
        <td class="text-center">{{ $customer->address }}</td>
        <td class="text-center d-flex justify-content-center">
            <a type="button" class="mr-2 btn btn-outline-info p-1" href="{{ route('customer.edit', $customer->id) }}">
                <span class="fa fa-edit mr-2"></span>Edit
            </a>
            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" accept-charset="utf-">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger p-1"><span class="fa fa-trash mr-2"></span>Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $customers->appends($_GET)->links() }}
</div>

</div>
@endsection
