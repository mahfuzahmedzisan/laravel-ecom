<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManagement\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $permissions = Permission::latest()->get();
        return view('backend.admin.adminManagement.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.adminManagement.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $validated = $request->validated();

        $validated['created_by'] = admin()->id;

        Permission::create($validated);

        session()->flash('success', 'Permission created successfully.');
        return redirect()->route('am.permission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission = Permission::findOrFail(decrypt($id));

        return view('backend.admin.adminManagement.permission.view', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail(decrypt($id));
        return view('backend.admin.adminManagement.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        $permission = Permission::findOrFail(decrypt($id));

        $validated = $request->validated();
        $validated['updated_by'] = admin()->id;

        $permission->update($validated);

        session()->flash('success', 'Permission updated successfully.');
        return redirect()->route('am.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail(decrypt($id));
        $permission->update(['deleted_by' => admin()->id]);
        $permission->delete();

        session()->flash('success', 'Permission deleted successfully.');
        return redirect()->route('am.permission.index');
    }

    public function trash()
    {

        $permissions = Permission::onlyTrashed()->latest()->get();
        $permissions->load('deletedBy');
        return view('backend.admin.adminManagement.permission.trash', compact('permissions'));
    }

    public function restore(string $id)
    {
        $permission = Permission::onlyTrashed()->findOrFail(decrypt($id));
        $permission->update(['deleted_by' => null, 'deleted_at' => null, 'updated_by' => admin()->id]);
        $permission->restore();

        session()->flash('success', 'Permission restored successfully.');

        $count = Permission::onlyTrashed()->count();
        if ($count == 0) {
            return redirect()->route('am.permission.index');
        }
        return redirect()->route('am.permission.trash');
    }

    public function forceDelete(string $id)
    {
        $permission = Permission::onlyTrashed()->findOrFail(decrypt($id));
        $permission->forceDelete();

        session()->flash('success', 'Permission permanently deleted successfully.');
        $count = Permission::onlyTrashed()->count();
        if ($count == 0) {
            return redirect()->route('am.permission.index');
        }
        return redirect()->route('am.permission.trash');
    }
}
