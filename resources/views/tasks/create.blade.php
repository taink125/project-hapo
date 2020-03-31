@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>Register Project</div>

            <div>
                <form method="POST" action="{{ route('project.store') }}" enctype='multipart/form-data'>
                    @csrf
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
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Project') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="customer_id">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $project->id == old('project') ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>

                            @error('customer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="image">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="customer_id">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $customer->id == old('customer_id') ? 'selected' : '' }}>{{ $customer->name }}</option>
                                @endforeach
                            </select>

                            @error('customer_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Leader') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="leader_id">
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" {{ $member->id == old('leader_id') ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>

                            @error('leader_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Members') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="leader_id">
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}" {{ $member->id == old('leader_id') ? 'selected' : '' }}>{{ $member->name }}</option>
                                @endforeach
                            </select>

                            @error('member_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('Start time') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control datepk @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required autocomplete="address">

                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ __('End time') }}</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control datepk @error('end_time') is-invalid @enderror" name="end_time" value="{{ old('end_time') }}" required autocomplete="address">

                            @error('end_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="status_id">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" {{ $status->id == old('status_id') ? 'selected' : '' }}>{{ $status->name }}</option>
                                @endforeach
                            </select>

                            @error('status_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>&nbsp;
                            <a href="{{ route('tasks.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.datepk').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush
@endsection
