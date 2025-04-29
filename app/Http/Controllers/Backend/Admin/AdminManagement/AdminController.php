<?php

namespace App\Http\Controllers\Backend\Admin\AdminManagement;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminManagement\AdminRequest;
use App\Models\Role;

class AdminController extends Controller
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
        $admins = Admin::orderBy('name')->get();
        return view('backend.admin.adminManagement.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('backend.admin.adminManagement.admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('admin', $fileName, 'public');
            $path = 'admin/' . $fileName;
            $validated['image'] = $path;
        }

        $validated['created_by'] = admin()->id;
        $admin = Admin::create($validated);
        $role = Role::findOrFail($request->role_id);
        $admin->assignRole($role);

        session()->flash('success', 'Admin created successfully.');
        return redirect()->route('am.admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Admin::findOrFail(decrypt($id));
        return view('backend.admin.adminManagement.admin.view', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['roles'] = Role::orderBy('name')->get();
        $data['admin'] = Admin::findOrFail(decrypt($id));
        return view('backend.admin.adminManagement.admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail(decrypt($id));

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('admin', $fileName, 'public');
            $path = 'admin/' . $fileName;
            $validated['image'] = $path;
            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }
        }

        $validated['password'] = isset($request->password) ? $request->password : $admin->password;
        $validated['updated_by'] = admin()->id;

        $admin->update($validated);
        $role = Role::findOrFail($request->role_id);
        $admin->syncRoles($role);

        session()->flash('success', 'Admin updated successfully.');
        return redirect()->route('am.admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = Admin::findOrFail(decrypt($id));
        $admin->update(['deleted_by' => admin()->id, 'status' => Admin::STATUS_INACTIVE]);
        $admin->delete();

        session()->flash('success', 'Admin deleted successfully.');
        return redirect()->route('am.admin.index');
    }

    public function status(string $id, string $status)
    {
        $admin = Admin::findOrFail(decrypt($id));
        $admin->update(['status' => decrypt($status), 'updated_by' => admin()->id]);

        session()->flash('success', 'Admin status updated successfully.');
        return redirect()->route('am.admin.index');
    }

    public function trash()
    {
        $admins = Admin::onlyTrashed()->latest()->get();
        $admins->load('deletedBy');
        return view('backend.admin.adminManagement.admin.trash', compact('admins'));
    }

    public function restore(string $id)
    {
        $admin = Admin::onlyTrashed()->findOrFail(decrypt($id));
        $admin->update(['deleted_by' => null, 'deleted_at' => null, 'updated_by' => admin()->id, 'status' => Admin::STATUS_ACTIVE]);
        $admin->restore();

        session()->flash('success', 'Admin restored successfully.');
        $count = Admin::onlyTrashed()->count();
        
        if ($count == 0) {
            return redirect()->route('am.admin.index');
        }
        return redirect()->route('am.admin.trash');
    }

    public function forceDelete(string $id)
    {
        $admin = Admin::onlyTrashed()->findOrFail(decrypt($id));
        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }
        $admin->forceDelete();

        session()->flash('success', 'Admin permanently deleted successfully.');

        $count = Admin::onlyTrashed()->count();
        if ($count == 0) {
            return redirect()->route('am.admin.index');
        }
        return redirect()->route('am.admin.trash');
    }
}
