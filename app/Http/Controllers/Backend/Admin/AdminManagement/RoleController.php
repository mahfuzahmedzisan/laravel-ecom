<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManagement\RoleRequest;

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
        $roles = Role::latest()->get();
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

        $validated['created_by'] = admin()->id;

        Role::create($validated);

        session()->flash('success', 'Role created successfully.');
        return redirect()->route('am.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::findOrFail(decrypt($id));

        return view('backend.admin.adminManagement.role.view', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail(decrypt($id));
        return view('backend.admin.adminManagement.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $role = Role::findOrFail(decrypt($id));

        $validated = $request->validated();
        $validated['updated_by'] = admin()->id;

        $role->update($validated);

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
        return redirect()->route('am.role.index');
    }

    public function forceDelete(string $id)
    {
        $role = Role::onlyTrashed()->findOrFail(decrypt($id));
        $role->forceDelete();

        session()->flash('success', 'Role permanently deleted successfully.');
        return redirect()->route('am.role.index');
    }
}