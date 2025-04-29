@extends('backend.admin.layouts.app', ['page_slug' => 'admin'])
@section('title', 'View Admin Details')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Admin Details</h4>
                    <div>
                        <a href="{{ route('am.admin.edit', encrypt($admin->id)) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('am.admin.index') }}" class="btn btn-info">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('Name') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $admin->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Image') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>
                                    <img src="{{ auth_storage_url($admin->image, $admin->gender) }}" class="img-fluid"
                                        alt="{{ $admin->name }}" style="width: 100px; height: auto;">
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Email') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $admin->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Phone') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $admin->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Gender') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $admin->gender_label }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Status') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>
                                    <span class="badge badge-{{ $admin->status_badge_color }}">
                                        {{ $admin->status_badge_label }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Permissions') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td width="60%" >
                                    @foreach ($admin->permissions_group as $prefix => $permissions)
                                        <div class="d-flex align-items-center flex-wrap mb-3">
                                            <h5 class="m-0 pe-3">{{ $prefix }} {{ __(' : ') }}</h5>
                                            <div class="d-flex gap-{50px} align-items-center flex-wrap gap-1 m-0 p-0">
                                                @foreach ($permissions as $permission)
                                                    <span class="badge bg-success-subtle text-dark">{{ $permission->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created At') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ timeFormat($admin->created_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Created By') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $admin->created_by_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated At') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ updatedDate($admin->created_at, $admin->updated_at) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('Updated By') }}</th>
                                <td>{{ __(' : ') }} </td>
                                <td>{{ $admin->updated_by_name }}</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
