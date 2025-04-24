@extends('backend.admin.layouts.app', ['page_slug' => 'permission'])
@section('title', 'View Permission Details')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Permission Details</h4>
                    <div>
                        <a href="{{ route('am.permission.edit', encrypt($permission->id)) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('am.permission.index') }}" class="btn btn-info">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Name') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Prefix') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $permission->prefix }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Guard Name') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created At') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ timeFormat($permission->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created By') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $permission->created_by_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated At') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ updatedDate($permission->created_at, $permission->updated_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated By') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $permission->updated_by_name }}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
