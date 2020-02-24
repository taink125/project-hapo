@extends('layouts.master')
@section('title', 'Statuses')
@section('management', 'List Statuses')
@section('content')
<div class="container-fluid">
    <!-- SEARCH FORM -->
    <form class="form-inline mb-3" method="get" action="">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" value="" name="keySearch" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar bg-success" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="w-50">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-plus mr-1"></i><a href=""></a>Add Status
        </button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add new status</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form action="{{ route('status.store') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="name" autofocus>

                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>  
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>                   
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-sm col-lg-4 col-md-8 col-sm-12 col-12">
        <tr class="thead-dark">
            <th scope="col">Name</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
        @foreach ($statuses as $status)
        <tr>
            <td scope="row">{{ $status->name }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('status.edit', $status->id) }}" class="btn btn-outline-info p-1 mr-1" data-toggle="modal" data-target="#updateModal{{ $status->id }}">
                    <span class="fa fa-edit mr-1"></span>Edit
                </a>
                <form action="{{ route('status.destroy', $status->id) }}" method="POST" accept-charset="utf-">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger p-1"><span class="fa fa-trash mr-2"></span>Delete</button>
                </form>
                <div class="">
                    <div class="modal fade" id="updateModal{{ $status->id }}"role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit status</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('status.update', $status->id) }}" method="post" accept-charset="utf-8">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (old('name')) ? old('name') : $status->name }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ (old('type')) ? old('type') : $status->type }}" required autocomplete="name" autofocus>

                                                @error('type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>                   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-end">
        {{ $statuses->appends($_GET)->links() }}
    </div>
    
</div>
@endsection
