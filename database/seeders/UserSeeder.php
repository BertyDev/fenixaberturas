<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Juan Carlos Fernandez',
            'email' => 'info@fenix.com.ar',
            'password' => bcrypt('12345678')
        ])->assignRole($role);

        User::create([
            'name' => 'Prueba',
            'email' => 'prueba@fenix.com.ar',
            'password' => bcrypt('12345678')
        ]);

        User::factory(50)->create();
    }
}
