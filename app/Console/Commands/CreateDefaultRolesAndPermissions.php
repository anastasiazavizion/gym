<?php
namespace App\Console\Commands;

use App\Enum\Role as RoleEnum;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Enum\Permissions\User as UserPermissions;
use Spatie\Permission\PermissionRegistrar;

class CreateDefaultRolesAndPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-roles-and-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ...UserPermissions::values(),
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }


        if (!Role::where('name', RoleEnum::ADMIN->value)->exists()) {
            (Role::create(['name' => RoleEnum::ADMIN->value]))
                ->givePermissionTo([...UserPermissions::values()]);
        }

        $admin = User::firstOrCreate(
            [
                'email' => 'a.zavizion.a@gmail.com',
            ],
            [
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'name' => 'nastya',
                'first_name' => 'Nastya',
                'last_name' => 'Zavizion',
            ]);
        $admin->assignRole(RoleEnum::ADMIN->value);
    }
}
