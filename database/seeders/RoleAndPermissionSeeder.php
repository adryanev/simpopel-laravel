<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->command->info('Cache Cleared');
        $permissionsByRole = [
            'employee' => ['create violation', 'view all violation', 'view rule', 'view penalty', 'request summon'],
            'student' => ['view own violation', 'view rule', 'view penalty'],
            'executive' => ['approve summon', 'create rule', 'create penalty', 'update violation', 'update rule', 'update penalty', 'delete rule', 'delete penalty'],
        ];
        $insertPermissions = fn ($role) => collect($permissionsByRole[$role])
            ->map(fn ($name) => DB::table('permissions')->insertGetId(['name' => $name,'guard_name'=>'web']))
            ->toArray();

        $permissionIdsByRole = [
            'employee' => $insertPermissions('employee'),
            'student' => $insertPermissions('student'),
            'executive' => $insertPermissions('executive')
        ];

        $this->command->info('Permission inserted');
        foreach ($permissionIdsByRole as $k => $permissionIds) {
            $role = Role::create(['name'=>$k]);

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn ($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }

        $this->command->info('Selesai Seeding');
        $superadmin = Role::create(['name'=>'superadmin']);
        $superadmin->givePermissionTo(Permission::all());
        //create super admin
        $user = User::factory()->state(['name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@simpopel.test',
            'type'=>User::TYPE_EMPLOYEE])->hasProfile(1)->hasEmployee(1)->create();

        $user->assignRole($superadmin);
    }
}
