@extends('backend.admin.layouts.app', ['page_slug' => 'admin'])
@section('title', 'Admin Management')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Admin Management</h4>
                    <div>
                        <a href="{{ route('am.admin.trash') }}" class="btn btn-info">Trash</a>
                        <a href="{{ route('am.admin.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive overflow-visible">
                        <table class="table table-striped table-hover" id="datatable">
                            <thead class="table-secondary">
                                <tr>
                                    <th>{{ __('#') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Created By') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            <span class="badge badge-{{ $admin->status_badge_color }}">
                                                {{ $admin->status_badge_label }}
                                            </span>
                                        </td>
                                        <td>{{ timeFormat($admin->created_at) }}</td>
                                        <td>{{ $admin->created_by_name }}</td>

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
                                                                href="{{ route('am.admin.show', encrypt($admin->id)) }}">
                                                                {{ __('Details') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('am.admin.edit', encrypt($admin->id)) }}">
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
                                                                @foreach ($admin->getStatusBtnText($admin->status) as $status)
                                                                    <li class="dropdown-item">
                                                                        <a href="{{ route('am.admin.status', [encrypt($admin->id), encrypt(array_search($status['text'], $admin->getStatus()))]) }}"
                                                                            class="text-{{ $status['class'] }}">
                                                                            {{ $status['text'] }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <a title="Delete" href="javascript:void(0)"
                                                                onclick="confirmDelete(() => document.getElementById('delete-form-{{ $admin->id }}').submit());"
                                                                class="dropdown-item text-danger" data-id="">
                                                                {{ __('Delete') }}
                                                            </a>
                                                            <form id="delete-form-{{ $admin->id }}"
                                                                action="{{ route('am.admin.destroy', encrypt($admin->id)) }}"
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

@push('js')
    <script>
        $(document).ready(function() {

            $('#datatable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                iDisplayLength: 10,
                order: [
                    [0, 'desc']
                ],
                buttons: [{
                        extend: 'pdfHtml5',
                        download: 'open',
                        orientation: 'potrait',
                        pagesize: 'A4',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    'excel', 'csv', 'pageLength',
                ]
            });

        });
    </script>
@endpush
