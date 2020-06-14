<?php

use Illuminate\Database\Seeder;

class ListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bases')->insert([
            'name' => 'Clients',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
