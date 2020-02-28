@extends('layouts.master')
@section('title', 'Projects')
@section('management', 'List Project')
@section('content')
<div class="container-fluid">
<!-- SEARCH FORM -->
<form class="form-inline mb-3" method="get" action="{{ route('project.search') }}">
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" value="{{ request()->input('keySearch') }}" name="keySearch" type="search" placeholder="Search"
            aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar bg-success" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>
</form>
<div class="">
    <a href="{{ route('project.create') }}" class="btn btn-primary bg-primary mb-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Project</a>
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
        <th class="text-center">Description</th>
        <th class="text-center">Customer</th>
        <th class="text-center">Leader</th>
        <th class="text-center">Start time</th>
        <th class="text-center">End time</th>
        <th class="text-center">Members</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
    </tr>
    @foreach($projects as $project)
    <tr>
        <td>{{ $project->name }}</td>
        <td class="text-center">{{ $project->description }}</td>
        <td>{{ $project->customer->name }}</td>
        <td class="text-center">{{ $project->leader->name }}</td>
        <td class="text-center">{{ $project->start_time }}</td>
        <td class="text-center">{{ $project->end_time }}</td>
        <td class="text-center">
            <select class="btn btn-outline-dark">
                @foreach ($project->members as $member)
                    <option>{{ $member->name }}</option>
                @endforeach
            </select>
        </td>
        <td class="text-center">{{ $project->status->name }}</td>
        <td class="text-center d-flex">
            <a type="button" class="mr-2 btn btn-outline-info p-1" href="{{ route('project.edit', $project->id) }}">
                <span class="fa fa-edit mr-2"></span>Edit
            </a>
            <form action="{{ route('project.destroy', $project->id) }}" method="POST" accept-charset="utf-">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger p-1"><span class="fa fa-trash mr-2"></span>Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $projects->appends($_GET)->links() }}
</div>

</div>
@endsection
