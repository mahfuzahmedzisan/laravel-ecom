<?php

use App\Http\Traits\AuditColumnTrait;
use App\Models\Admin;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    use SoftDeletes, AuditColumnTrait;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $this->addAdminAuditColumns($table);

            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(Admin::STATUS_ACTIVE)->comment(Admin::STATUS_ACTIVE . ' = Active, ' . Admin::STATUS_PENDING . ' = Pending, ' . Admin::STATUS_INACTIVE . ' = Inactive');
            $table->string('gender')->default(Admin::GENDER_OTHER)->comment(Admin::GENDER_MALE . ' = Male, ' . Admin::GENDER_FEMALE . ' = Female, ' . Admin::GENDER_OTHER . ' = Other');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
