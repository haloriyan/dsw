<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Master Admin',
            'email' =>'admin@gmail.com',
            'password' => bcrypt('inikatasandi'),
            'username' => 'adminmaster',
            'phone' => '08185277446464',
            'is_super' => 1,
            'role' => 'superadmin'
        ]);
    }
}
