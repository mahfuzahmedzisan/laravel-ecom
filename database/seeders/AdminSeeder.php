<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => 'superadmin@admin.com',
            'role_id' => 1
        ]);
        $superAdmin->assignRole($superAdmin->role->name);
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'admin@admin.com',
            'role_id' => 2
        ]);
        $admin->assignRole($admin->role->name);
    }
}
