<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Empresas2TableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BasicoTableSeeder::class);
        $this->call(TesteInd2TableSeeder::class);
    }
}
