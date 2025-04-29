<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManagement\RoleRequest;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'asc')->get();
        return view('backend.admin.adminManagement.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['grouped_permissions'] = Permission::orderBy('prefix')->get()->groupBy('prefix');
        return view('backend.admin.adminManagement.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $request) {
            $validated['created_by'] = admin()->id;
            $role = Role::create($validated);
            $role->givePermissionTo($request->permissions);
        });

        session()->flash('success', 'Role created successfully.');
        return redirect()->route('am.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['role'] = Role::with('permissions:id,name,prefix')->findOrFail(decrypt($id));
        $data['role']->permissions_group = $data['role']->permissions->groupBy('prefix');
        return view('backend.admin.adminManagement.role.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['role'] = Role::findOrFail(decrypt($id));
        $data['grouped_permissions'] = Permission::orderBy('prefix')->get()->groupBy('prefix');
        return view('backend.admin.adminManagement.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $request, $id) {
            $role = Role::findOrFail(decrypt($id));
            $validated['updated_by'] = admin()->id;
            $role->update($validated);
            $role->syncPermissions($request->permissions);
        });

        session()->flash('success', 'Role updated successfully.');
        return redirect()->route('am.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail(decrypt($id));
        $role->update(['deleted_by' => admin()->id]);
        $role->delete();

        session()->flash('success', 'Role deleted successfully.');
        return redirect()->route('am.role.index');
    }

    public function trash()
    {

        $roles = Role::onlyTrashed()->latest()->get();
        $roles->load('deletedBy');
        return view('backend.admin.adminManagement.role.trash', compact('roles'));
    }

    public function restore(string $id)
    {
        $role = Role::onlyTrashed()->findOrFail(decrypt($id));
        $role->update(['deleted_by' => null, 'deleted_at' => null, 'updated_by' => admin()->id]);
        $role->restore();

        session()->flash('success', 'Role restored successfully.');
        $count = Role::onlyTrashed()->count();
        if ($count == 0) {
            return redirect()->route('am.role.index');
        }
        return redirect()->route('am.role.trash');
    }

    public function forceDelete(string $id)
    {
        $role = Role::onlyTrashed()->findOrFail(decrypt($id));
        $role->forceDelete();

        session()->flash('success', 'Role permanently deleted successfully.');
        $count = Role::onlyTrashed()->count();
        if ($count == 0) {
            return redirect()->route('am.role.index');
        }
        return redirect()->route('am.role.trash');
    }
}
