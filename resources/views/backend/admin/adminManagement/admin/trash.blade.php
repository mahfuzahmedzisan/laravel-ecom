@extends('backend.admin.layouts.app', ['page_slug' => 'admin'])
@section('title', 'Admin Restore')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Admin Restore</h4>
                    <div>
                        <a href="{{ route('am.admin.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive overflow-visible">
                        <table class="table table-striped table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Deleted At') }}</th>
                                    <th>{{ __('Deleted By') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <span class="badge badge-{{ $admin->status_badge_color }}">
                                                {{ $admin->status_badge_label }}
                                            </span>
                                        </td>
                                        <td>{{ timeFormat($admin->deleted_at) }}</td>
                                        <td>{{ $admin->deleted_by_name }}</td>

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
                                                                href="{{ route('am.admin.restore', encrypt($admin->id)) }}">
                                                                {{ __('Restore') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a title="Delete" class="dropdown-item text-danger"
                                                                href="javascript:void(0)" onclick="confirmPermanentDelete('{{ route('am.admin.force-delete', encrypt($admin->id)) }}')">
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
