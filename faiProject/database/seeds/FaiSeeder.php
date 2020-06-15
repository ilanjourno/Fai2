<?php

use Illuminate\Database\Seeder;

class FaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array  = [
            ['name' => 'orange', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'free', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'gmail', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'sfr', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'laposte', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'autre', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'hotmail', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'yahoo', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'aol', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'bbox', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'apple', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'autrefr', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'suisse', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'belgique', 'created_at' => now(),
            'updated_at' => now()], ['name' => 'tiscali', 'created_at' => now(),
            'updated_at' => now()]
        ];
        DB::table('fais')->insert($array);
    }
}
