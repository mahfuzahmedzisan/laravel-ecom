<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use SoftDeletes;
    
    protected $table = 'permissions';
    protected $fillable = [
        'name',
        'prefix',
        'guard_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    protected $casts = [
        'name' => 'string',
        'prefix' => 'string',
        'guard_name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer',
    ];
    protected $appends = [
        'created_by_name',
        'updated_by_name',
        'deleted_by_name',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id');
    }
    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_has_permissions', 'permission_id', 'admin_id');
    }

    public function CreatedBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function UpdatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
    public function DeletedBy()
    {
        return $this->belongsTo(Admin::class, 'deleted_by');
    }
    public function getCreatedByNameAttribute()
    {
        return $this->createdBy ? $this->createdBy->name : 'System';
    }
    public function getUpdatedByNameAttribute()
    {
        return $this->updatedBy ? $this->updatedBy->name : 'Null';
    }
    public function getDeletedByNameAttribute()
    {
        return $this->deletedBy ? $this->deletedBy->name : 'Null';
    }
    public function getRouteKeyName()
    {
        return 'name';
    }
    public function getRouteKey()
    {
        return $this->name;
    }
    public function getRouteKeyPrefix()
    {
        return $this->prefix;
    }
    public function getRouteKeyGuard()
    {
        return $this->guard_name;
    }
}
