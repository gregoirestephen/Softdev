<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProfilsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profils')->insert([
           'lib_p'=>'Administrateur',
        ]);

        DB::table('profils')->insert([
           'lib_p'=>'Medecin',
        ]);

        DB::table('profils')->insert([
            'lib_p'=>'Secretaire',
        ]);
    }
}
