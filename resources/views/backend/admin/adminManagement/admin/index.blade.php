@extends('backend.admin.layouts.app', ['page_slug' => 'admin'])
@section('title', 'Admin Management')
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
                    <div class="table-responsive">
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
                                        <td><span class="badge {{ $admin->status_badge_color }}">{{ $admin->status_badge_label }}</span></td>
                                        <td>{{ timeFormat($admin->created_at) }}</td>
                                        <td>{{ $admin->createdBy->name ?? 'System'}}</td>
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
