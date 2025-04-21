<?php

namespace App\Http\Traits;

use Illuminate\Database\Schema\Blueprint;

trait AuditColumnTrait
{
    public function addAdminAuditColumns(Blueprint $table)
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
    }

    public function dropAdminAuditColumns(Blueprint $table)
    {
        $table->dropForeign('created_by');
        $table->dropForeign('updated_by');
        $table->dropForeign('deleted_by');
        $table->dropColumn(['created_by', 'updated_by', 'deleted_by']);
    }

    public function addMorpheAuditColumns(Blueprint $table)
    {
        $table->unsignedBigInteger('creater_id')->nullable();
        $table->string('creater_type')->nullable();
        $table->unsignedBigInteger('updater_id')->nullable();
        $table->string('updater_type')->nullable();
        $table->unsignedBigInteger('deleter_id')->nullable();
        $table->string('deleter_type')->nullable();
    }

    public function dropMorpheAuditColumns(Blueprint $table)
    {
        $table->dropForeign('creater_id');
        $table->dropForeign('updater_id');
        $table->dropForeign('deleter_id');

        $table->dropColumn(['creater_id', 'updater_id','deleter_id']);
    }
}
