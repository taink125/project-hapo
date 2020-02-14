@extends('layouts.master')
@section('title', 'Members')
@section('management', 'List Members')
@section('content')
<div class="container-fluid">
<div class="w-50">
    <a href="{{ route('member.create') }}" class="btn btn-primary bg-primary mb-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Member</a>
</div>
<table class="table table-bordered table-sm table-striped table-hover">
    <tr class="thead-dark">
        <th class="text-center">ID</th>
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
        <td class="text-center">{{ $member->id }}</td>
        <td>{{ $member->name }}</td>
        <td class="text-center"><img class="w-25" src="/dist/img/{{ $member->image }}" alt="avatar"></td>
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
<div>
   {{ $members->links() }} 
</div>

</div>
@endsection
