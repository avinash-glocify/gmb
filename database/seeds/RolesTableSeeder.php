<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['user','Admin'];

        foreach ($roles as $key => $role) {
            Role::updateOrCreate(['name' => $role]);
        }
    }
}
