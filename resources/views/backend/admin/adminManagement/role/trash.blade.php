@extends('backend.admin.layouts.app', ['page_slug' => 'role'])
@section('title', 'Role Restore')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Role Restore</h4>
                    <div>
                        <a href="{{ route('am.role.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive overflow-visible">
                        <table class="table table-striped table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Guard Name') }}</th>
                                    <th>{{ __('Deleted At') }}</th>
                                    <th>{{ __('Deleted By') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->guard_name }}</td>
                                        <td>{{ timeFormat($role->deleted_at) }}</td>
                                        <td>{{ $role->deleted_by_name }}</td>

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
                                                                href="{{ route('am.role.restore', encrypt($role->id)) }}">
                                                                {{ __('Restore') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a title="Delete" class="dropdown-item text-danger"
                                                                href="javascript:void(0)"
                                                                onclick="confirmPermanentDelete('{{ route('am.role.force-delete', encrypt($role->id)) }}')">
                                                                {{ __('Permanently Delete') }}
                                                            </a>

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
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
