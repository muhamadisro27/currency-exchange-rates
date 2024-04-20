<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $users, $roles, $permissions;

    public function __construct() {
        $this->users = json_decode(file_get_contents(base_path('database/data/users/user.json'), true));
        $this->roles = json_decode(file_get_contents(base_path('database/data/users/role.json'), true));
        $this->permissions = json_decode(file_get_contents(base_path('database/data/users/permission.json'), true));
    }

    public function run(): void
    {
        $this->command->info('initial permissions');
        $this->command->getOutput()->progressStart(count($this->permissions));
        foreach ($this->permissions as $permission) {
            $this->initializePermission($permission);
            $this->command->getOutput()->progressAdvance();
        }

        // initial role
        $this->command->info('initial roles');
        $this->command->getOutput()->progressStart(count($this->roles));
        foreach ($this->roles as $role) {
            $this->initializeRole($role);
            $this->command->getOutput()->progressAdvance();
        }

        // initial user
        $this->command->info('initial users');
        $this->command->getOutput()->progressStart(count($this->users));
        foreach ($this->users as $user) {
            $this->initializeUser($user);
            $this->command->getOutput()->progressAdvance();
        }
    }

    protected function initializePermission($permission)
    {
        Permission::firstOrcreate([
            'name' => $permission->name,
        ], [
            'category' => $permission->category,
            'guard_name' => 'web',
        ]);
    }

    protected function initializeRole($role)
    {
        $new_role = Role::firstOrcreate([
            'name' => $role->name,
        ], [
            'uuid' => Uuid::uuid1(),
            'guard_name' => 'web'
        ]);

        $new_role->givePermissionTo($role->permissions);
    }

    protected function initializeUser($user)
    {
        $new_user = User::withoutEvents(function () use ($user) {
            return User::firstOrCreate([
                "name" => $user->name,
            ], [
                "uuid" => Uuid::uuid1(),
                "email" => $user->email,
                "email_verified_at" => null,
                "password" => bcrypt($user->password),
            ]);
        });

        $new_user->syncRoles($user->roles);

        $role = Role::where('name', $new_user->roles->pluck('name')[0])->first();

        $new_user->syncPermissions($role->permissions);
    }
}
