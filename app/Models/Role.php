<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = [
        'name',
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
        'guard_name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'deleted_by' => 'integer',
    ];

    public function permission()
    {
        return $this->hasMany(Permission::class, 'role_id');
    }
    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id', 'id');
    }

    // protected $hidden = [
    //     'created_by',
    //     'updated_by',
    //     'deleted_by',
    // ];
    protected $appends = [
        'created_by_name',
        'updated_by_name',
        'deleted_by_name',
    ];
    // protected $with = [
    //     'permissions',
    // ];
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

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }
    // public function getRouteKey()
    // {
    //     return $this->getAttribute($this->getRouteKeyName());
    // }
}
