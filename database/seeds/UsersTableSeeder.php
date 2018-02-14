<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'empresa_id' => 1,
            'login' => 'U1008250',
            'nome' => 'Flávio Monteiro Moraes',
            'email' => 'flavio.moraes@celpa.com.br',
            'nivel' => 'Admin',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ],
        [
            'empresa_id' => 1,
            'login' => 'U1010382',
            'nome' => 'Diego Moraes',
            'email' => 'diego.rosario@celpa.com.br',
            'nivel' => 'Admin',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
     }
}
