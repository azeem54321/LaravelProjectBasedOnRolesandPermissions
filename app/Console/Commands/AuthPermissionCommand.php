<?php

namespace App\Console\Commands;

use App\Role;
use App\Permission;
use Illuminate\Console\Command;

class AuthPermissionCommand extends Command
{

    protected $signature = 'auth:permission {name} {--R|remove}';

    protected $description = 'Create auth permissions for a model';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $permissions = $this->generatePermissions();


        // check if its remove
        if( $is_remove = $this->option('remove') ) {
            // remove permission
            if( Permission::where('name', 'LIKE', '%'. $this->getNameArgument())->delete() ) {
                $this->warn('Permissions ' . implode(', ', $permissions) . ' deleted.');
            }  else {
                $this->warn('No permissions for ' . $this->getNameArgument() .' found!');
            }

        } else {
            // create permissions
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission ]);
            }

            $this->info('Permissions ' . implode(', ', $permissions) . ' created.');
        }

        // sync role for admin
        if( $role = Role::where('name', 'Admin')->first() ) {
            $role->syncPermissions(Permission::all());
            $this->info('Admin permissions');
        }
    }
    private function generatePermissions()
    {
        $abilities = ['view', 'add', 'edit', 'delete'];
        $name = $this->getNameArgument();

        return array_map(function($val) use ($name) {
            return $val . '_'. $name;
        }, $abilities);
    }

    private function getNameArgument()
    {
        return strtolower(str_plural($this->argument('name')));
    }
}
