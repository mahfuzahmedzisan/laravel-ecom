@extends('backend.admin.layouts.app', ['page_slug' => 'role'])
@section('title', 'View Role Details')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Role Details</h4>
                    <div>
                        <a href="{{ route('am.role.edit', encrypt($role->id)) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('am.role.index') }}" class="btn btn-info">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Name') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Guard Name') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $role->guard_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Permissions') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>
                                    @foreach ($role->permissions_group as $prefix => $permissions)
                                       <div class="d-flex align-items-center flex-wrap gap-3">
                                        <h5 class="m-0 p-0">{{ $prefix }}</h5>
                                        <p class="m-0 p-0">{{ __(' : ') }}</p>
                                        <div class="d-flex align-items-center flex-wrap gap-1 list-unstyled m-0 p-0">
                                            @foreach ($permissions as $permission)
                                                <span>({{ $permission->name }})</span>
                                            @endforeach
                                        </div>
                                       </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created At') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ timeFormat($role->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created By') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $role->created_by_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated At') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ updatedDate($role->created_at, $role->updated_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated By') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $role->updated_by_name }}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
