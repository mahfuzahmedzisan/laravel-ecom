@extends('backend.admin.layouts.app', ['page_slug' => 'permission'])
@section('title', 'Permission Management')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Permission Management</h4>
                    <div>
                        <a href="{{ route('am.permission.trash') }}" class="btn btn-info">Trash</a>
                        <a href="{{ route('am.permission.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive overflow-visible">
                        <table class="table table-striped table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Prefix') }}</th>
                                    <th>{{ __('Guard Name') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Created By') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($permissions as $permission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->prefix }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                        <td>{{ timeFormat($permission->created_at) }}</td>
                                        <td>{{ $permission->created_by_name }}</td>

                                        <td>
                                            <div
                                                class="btn-group d-flex align-items-center gap-3 flex-wrap justify-content-start">
                                                <i class="icon-grid reorder fs-4 float-left" style="cursor: move;"></i>

                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="icon-settings fs-3 setting"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                        aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('am.permission.show', encrypt($permission->id)) }}">
                                                                {{ __('Details') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('am.permission.edit', encrypt($permission->id)) }}">
                                                                {{ __('Edit') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a title="Delete" href="javascript:void(0)"
                                                                onclick="confirmDelete(() => document.getElementById('delete-form-{{ $permission->id }}').submit());"
                                                                class="dropdown-item text-danger" data-id="">
                                                                {{ __('Delete') }}
                                                            </a>
                                                            <form id="delete-form-{{ $permission->id }}"
                                                                action="{{ route('am.permission.destroy', encrypt($permission->id)) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-secondary mb-0">
                                                {{ __('No data found') }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
