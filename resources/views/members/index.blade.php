@extends('layouts.master')
@section('title', 'Members')
@section('management', 'List Members')
@section('content')
<div class="container-fluid">
<div class="w-50">
    <a href="{{ route('member.create') }}" class="btn btn-primary bg-primary mb-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Member</a>
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
        <th class="text-center">Role</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach($members as $member)
    <tr>
        <td>{{ $member->name }}</td>
        <td class="text-center"><img style="width: 100px; height: 128px; object-fit: contain;" src="{{ asset("storage/images/$member->image") }}" alt="avatar"></td>
        <td>{{ $member->email }}</td>
        <td class="text-center">{{ $member->phone }}</td>
        <td class="text-center">{{ $member->address }}</td>
        <td class="text-center">{{ $member->is_admin_label }}</td>
        <td class="text-center d-flex justify-content-center">
            <a type="button" class="mr-2 btn btn-outline-info p-1" href="{{ route('member.edit', $member->id) }}">
                <span class="fa fa-edit mr-2"></span>Edit
            </a>
            <form action="{{ route('member.destroy', $member->id) }}" method="POST" accept-charset="utf-">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger p-1"><span class="fa fa-trash mr-2"></span>Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $members->appends($_GET)->links() }}
</div>

</div>
@endsection
