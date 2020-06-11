<?php

namespace App\Jobs;

use \App\Destinataire;
use \App\Liste;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class ProcessMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $array;
    public $emails;
    public $id;
    public function __construct($emails, $id)
    {
        $this->id = $id;
        $this->array = $emails;
    }

    public function handle()
    {
        foreach ($this->array as $key => $mail) {
            $this->emails[] = [
                'email' => $mail,
                'list_id' => $this->id,
            ];
        }
        ini_set('memory_limit', '-1');
        $this->sendMailToServer();
    }

    public function sendMailToServer(){
        Destinataire::insertOrIgnore($this->emails);
    }

}
