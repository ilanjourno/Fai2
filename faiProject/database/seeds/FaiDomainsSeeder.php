<?php

use Illuminate\Database\Seeder;

class FaiDomainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            // Orange
            ['fais_id' => 1, 'domains' => 'orange.fr', 'created_at' => now(),
            'updated_at' => now()], 
            ['fais_id' => 1, 'domains' => 'wanadoo.fr', 'created_at' => now(),
            'updated_at' => now()], 
            ['fais_id' => 1, 'domains' => 'voila.fr', 'created_at' => now(),
            'updated_at' => now()],
            // Free
            ['fais_id' => 2, 'domains' => 'free.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'freesbee.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'libertysurf.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'worldonline.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'online.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'alicepro.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'aliceadsl.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'alicemail.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 2, 'domains' => 'infonie.fr', 'created_at' => now(),
            'updated_at' => now()],
            // Gmail
            ['fais_id' => 3, 'domains' => 'gmail.com', 'created_at' => now(),
            'updated_at' => now()],
            // Sfr
            ['fais_id' => 4, 'domains' => 'sfr.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'neuf.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'cegetel.net', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'club-internet.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'numericable.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'numericable.com', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'noos.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 4, 'domains' => 'neufcegetel.fr', 'created_at' => now(),
            'updated_at' => now()],
            // La poste
            ['fais_id' => 5, 'domains' => 'laposte.net', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 5, 'domains' => 'laposte.fr', 'created_at' => now(),
            'updated_at' => now()],
            // Autre
            ['fais_id' => 6, 'domains' => 'blabla.com', 'created_at' => now(),
            'updated_at' => now()],
            // Hotmail
            ['fais_id' => 7, 'domains' => 'hotmail.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 7, 'domains' => 'msn.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 7, 'domains' => 'live.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 7, 'domains' => 'outlook.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 7, 'domains' => 'outlook.com', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 7, 'domains' => 'msn.com', 'created_at' => now(),
            'updated_at' => now()],
            // Yahoo
            ['fais_id' => 8, 'domains' => 'yahoo.fr', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 8, 'domains' => 'yahoo.com', 'created_at' => now(),
            'updated_at' => now()],
            // Aol
            ['fais_id' => 9, 'domains' => 'aol.com', 'created_at' => now(),
            'updated_at' => now()],
            ['fais_id' => 9, 'domains' => 'aol.fr', 'created_at' => now(),
            'updated_at' => now()],
            // Bbox
            ['fais_id' => 10, 'domains' => 'bbox.fr', 'created_at' => now(),
            'updated_at' => now()],
            // Apple
            ['fais_id' => 11, 'domains' => 'icloud.com', 'created_at' => now(),
            'updated_at' => now()],
            // Autrefr
            ['fais_id' => 12, 'domains' => 'autrefr', 'created_at' => now(),
            'updated_at' => now()],
            // Suisse
            ['fais_id' => 13, 'domains' => 'adressesuisse', 'created_at' => now(),
            'updated_at' => now()],
            // Belgique
            ['fais_id' => 14, 'domains' => 'adressebelgique', 'created_at' => now(),
            'updated_at' => now()],
            // Tiscali
            ['fais_id' => 15, 'domains' => 'tiscali.fr', 'created_at' => now(),
            'updated_at' => now()],
        ]; 
        DB::table('fais_domains')->insert($array);
    }
}
