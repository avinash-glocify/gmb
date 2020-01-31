<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('projectEnum.permissions');

        foreach($permissions as $key => $permission) {
          Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
