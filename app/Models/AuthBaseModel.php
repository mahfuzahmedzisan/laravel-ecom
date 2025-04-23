<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AuthBaseModel extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(Admin::class, 'deleted_by');
    }

    public function creator()
    {
        return $this->morphTo();
    }
    public function updater()
    {
        return $this->morphTo();
    }
    public function deleter()
    {
        return $this->morphTo();
    }

    public const STATUS_ACTIVE = 2;
    public const STATUS_PENDING = 1;
    public const STATUS_INACTIVE = 0;

    public const GENDER_MALE = 1;
    public const GENDER_FEMALE = 2;
    public const GENDER_OTHER = 3;

    protected $appends = [
        'status_badge_label',
        'status_badge_color',
        'gender_label',
    ];

    public function getStatus()
    {
        return  [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_PENDING => 'Pending',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public function getStatusBtnText($currentStatus)
    {
        $statusTexts = [];

        foreach ($this->getStatus() as $key => $value) {
            if ($key == $currentStatus) {
                continue;
            }

            $statusTexts[] = [
                'class' => $this->getStatusBg()[$key] ?? 'secondary',
                'text'  => $value,
            ];
        }

        return $statusTexts;
    }

    public function getStatusBg()
    {
        return  [
            self::STATUS_ACTIVE => 'success',
            self::STATUS_PENDING => 'info',
            self::STATUS_INACTIVE => 'warning',
        ];
    }

    public function getStatusBadgeLabelAttribute()
    {
        return $this->getStatus()[$this->status] ?? 'Unknown';
    }

    public function getStatusBadgeColorAttribute()
    {
        return $this->getStatusBg()[$this->status] ?? 'bg-secondary';
    }

    public function getGender()
    {
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
            self::GENDER_OTHER => 'Other',
        ];
    }

    public function getGenderLabelAttribute()
    {
        return $this->getGender()[$this->gender] ?? 'Unknown';
    }
}
