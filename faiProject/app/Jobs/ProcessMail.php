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
    public $array;
    public $emails;
    public $id;
    public $base_id;
    public function __construct($emails, $id, $base_id)
    {
        $this->id = $id;
        $this->base_id = $base_id;
        $this->array = $emails;
    }

    public function handle()
    {
        foreach ($this->array as $key => $mail) {
            $this->emails[] = [
                'email' => $mail,
                'list_id' => $this->id,
                'base_id' => $this->base_id,
                'sha256' => hash('sha256', $mail),
                'md5' => md5($mail)
            ];
        }
        $this->sendMailToServer();
    }

    public function sendMailToServer(){
        Destinataire::insertOrIgnore($this->emails);
    }

}
