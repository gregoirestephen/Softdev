<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'profil_id'=>1,
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'contact'=>90117902,
            'password'=>\Illuminate\Support\Facades\Hash::make('@@12345678')
        ]);
    }
}
