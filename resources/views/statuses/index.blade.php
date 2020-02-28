@extends('layouts.master')
@section('title', 'Statuses')
@section('management', 'List Statuses')
@section('content')
<div class="container-fluid">
    <!-- SEARCH FORM -->
    <form class="form-inline mb-3" method="get" action="{{ route('status.search') }}">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" value="{{ request()->input('keySearch') }}" name="keySearch" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar bg-success" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="">
	    <a href="{{ route('status.create') }}" class="btn btn-primary bg-primary mb-3"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Status</a>
	    @if (session('success'))
	        <div class="alert alert-success alert-dismissible fade show" role="alert">
	            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;
	            </a> {{ session('success') }}
	        </div>
	    @endif
	</div>
	<div class="d-flex">
	    <div class="w-50">
	    	<table class="table table-bordered table-sm">
		        <tr class="thead-dark">
		            <th scope="col">Name</th>
		            <th scope="col" class="text-center">Action</th>
		        </tr>
		        @foreach ($statuses as $status)
		        <tr>
		            <td scope="row">{{ $status->name }}</td>
		            <td class="d-flex justify-content-center">
		                <a href="{{ route('status.edit', $status->id) }}" class="btn btn-outline-info p-1 mr-1">
		                    <span class="fa fa-edit mr-1"></span>Edit
		                </a>
		                <form action="{{ route('status.destroy', $status->id) }}" method="POST" accept-charset="utf-8">
		                    @method('DELETE')
		                    @csrf
		                    <button type="submit" class="btn btn-outline-danger p-1"><span class="fa fa-trash mr-2"></span>Delete</button>
		                </form>
		            </td>
		        </tr>
		        @endforeach
		    </table>
	    </div>
	</div>

    <div class="d-flex justify-content-end">
        {{ $statuses->appends($_GET)->links() }}
    </div>
    
</div>
@endsection
