@extends('backend.admin.layouts.app', ['page_slug' => 'admin'])
@section('title', 'Admin Management')
@push('css')
    <style>
        .dropdown-menu .dropdown-menu {
            display: none;
            position: absolute;
            right: 100%;
            top: 0;
            margin-left: 0.1rem;
        }

        .dropdown-menu .dropdown:hover>.dropdown-menu {
            display: block;
        }

        .dropdown i.setting {
            color: #2d2d2d;
            transition: all 0.5s linear;
        }

        .dropdown i.setting:hover {
            transform: rotate(90deg) !important;
            color: #007bff;
        }
    </style>
@endpush
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Admin Management</h4>
                    <div>
                        <a href="" class="btn btn-info">Trash</a>
                        <a href="" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive overflow-visible">
                        <table class="table striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <span class="badge {{ $admin->status_badge_color }}">
                                                {{ $admin->status_badge_label }}
                                            </span>
                                        </td>
                                        <td>{{ timeFormat($admin->created_at) }}</td>
                                        <td>{{ $admin->createdBy->name ?? 'System' }}</td>

                                        <td>
                                            <div
                                                class="btn-group d-flex align-items-center gap-3 flex-wrap justify-content-center">
                                                <i class="icon-grid reorder fs-4 float-left" style="cursor: move;"></i>

                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" type="button"
                                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="icon-settings fs-3 setting"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                {{ __('Details') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                {{ __('Edit') }}
                                                            </a>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a class="dropdown-item dropdown-toggle"
                                                                href="javascript:void(0)" id="status" role="button"
                                                                aria-expanded="false">
                                                                {{ __('Status') }}
                                                            </a>
                                                            <ul class="dropdown-menu" aria-labelledby="status">
                                                                @foreach ($admin->getStatus() as $status)
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="#">{{ $status }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <a title="Delete" href="javascript:void(0)"
                                                                onclick="function(e) {
                                                                e.preventDefault();
                                                                document.getElementById('delete-form-{{ $admin->id }}').submit();
                                                            }"
                                                                class="dropdown-item text-danger" data-id="">
                                                                {{ __('Delete') }}
                                                            </a>
                                                            <form id="delete-form-{{ $admin->id }}"
                                                                action="{{ route('am.admin.destroy', $admin->id) }}"
                                                                method="DELETE">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.dropdown-menu .dropdown').hover(function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
            }, function() {
                $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
            });
        });
    </script>
@endpush
