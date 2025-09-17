<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $superAdminRole = Role::findOrCreate('super_admin', 'web');
        $user = User::create([
            'name' => 'admincomp',
            'email' => 'super@admin.com',
            'password' => bcrypt('12121212')
        ]);

        $user->assignRole($superAdminRole);


        $designManagerRole = Role::findOrCreate('design_manager', 'web');
        $designManagerPermissions = [
            'manage products',
            'manage principles',
            'manage testimonials',
        ];

        $designManagerRole->syncPermissions($designManagerPermissions);
    }
}
