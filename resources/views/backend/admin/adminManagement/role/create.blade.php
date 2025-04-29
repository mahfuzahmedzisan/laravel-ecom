@extends('backend.admin.layouts.app', ['page_slug' => 'role'])
@section('title', 'Create Role')
@push('css')
    <style>
        .groupName {
            background: #eeeeee;
            border-bottom: 2px solid #acacac;
            font-weight: bold;
            text-transform: uppercase;
        }

        .groupName label {
            color: #2d2d2d;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .list-items li {
            list-style: none;
            background: #eeeeee;
            border-bottom: 2px solid #acacac;
        }

        .list-items li label {
            color: #2d2d2d;
            font-weight: bold;
            text-transform: capitalize;
        }
    </style>
@endpush
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
                                                <h3 class="m-0 pl-4 groupName d-flex align-items-center w-100">
                                                    <input type="checkbox" class="m-2 prefix-checkbox"
                                                        id="prefix-checkbox-{{ $prefix }}"
                                                        data-prefix="{{ $prefix }}">
                                                    <label class="w-100"
                                                        for="prefix-checkbox-{{ $prefix }}">{{ $prefix }}</label>
                                                </h3>
                                                <ul class="list-items p-0">
                                                    @foreach ($permissions as $permission)
                                                        <li class="ps-4 d-flex align-items-center w-100">
                                                            <input type="checkbox" name="permissions[]"
                                                                id="permission-checkbox-{{ $permission->id }}"
                                                                value="{{ $permission->name }}"
                                                                class=" m-2 permission-checkbox">
                                                            <label class="w-100"
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
@push('js')
    <script>
        $(document).ready(function() {
            $('.prefix-checkbox').on('click', function() {
                // var prefix = $(this).data('prefix');
                var permissionCheckboxes = $(this).closest('h3').next('ul').find('.permission-checkbox');
                var isChecked = $(this).prop('checked');

                permissionCheckboxes.prop('checked', isChecked);
            });

            $('.permission-checkbox').on('click', function() {
                var checkboxId = $(this).attr('id');
                var prefix = $(this).closest('ul').prev('h3').find('.prefix-checkbox');
                var permissionCheckboxes = $(this).closest('ul').find('.permission-checkbox');
                var isAllChecked = permissionCheckboxes.length === permissionCheckboxes.filter(':checked')
                    .length;

                prefix.prop('checked', isAllChecked);
            });
            $('label[for^="permission-checkbox-"]').on('click', function() {
                var checkboxId = $(this).attr('for');
                $('#' + checkboxId).prop('checked');
            });
            $('label[for^="permission-checkbox-"]').on('click', function() {
                var checkboxId = $(this).attr('for');
                $('#' + checkboxId).prop('checked');
            });
        });
    </script>
@endpush
