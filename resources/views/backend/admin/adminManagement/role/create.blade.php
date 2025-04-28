@extends('backend.admin.layouts.app', ['page_slug' => 'role'])
@section('title', 'Create Role')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Create Role</h4>
                    <div>
                        <a href="{{ route('am.role.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('am.role.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($grouped_permissions->chunk(1) as $chunks)
                                        <div class="col-md-3">
                                            @foreach ($chunks as $prefix => $permissions)
                                                <h3 class="m-0 pl-4 groupName">
                                                    <input type="checkbox" class="m-2 prefix-checkbox"
                                                        id="prefix-checkbox-{{ $prefix }}"
                                                        data-prefix="{{ $prefix }}">
                                                    <label
                                                        for="prefix-checkbox-{{ $prefix }}">{{ $prefix }}</label>
                                                </h3>
                                                <ul>
                                                    @foreach ($permissions as $permission)
                                                        <li class="ps-4">
                                                            <input type="checkbox" name="permissions[]"
                                                                id="permission-checkbox-{{ $permission->id }}"
                                                                value="{{ $permission->name }}"
                                                                class=" m-2 permission-checkbox">
                                                            <label
                                                                for="permission-checkbox-{{ $permission->id }}">{{ Str::replace('_', ' ', $permission->name) }}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
