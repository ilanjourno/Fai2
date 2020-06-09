<?php

namespace App\Jobs;

use \App\Destinataire;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $emails;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emails)
    {
        
        $this->emails = $emails;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $key => $mail) {
            $array[] = [
                'emails' => $mail,
                'list_id' => 1,
            ];
        }
        Destinataire::insertOrIgnore($array);
    }

}
