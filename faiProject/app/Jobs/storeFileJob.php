<?php

namespace App\Jobs;

use \App\Base;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class storeFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $config;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($base, $file)
    {
        $this->config = [
            'base_name' => $base['name'],
            'base_id' => $base['id'],
            'file_name' => $file->getClientOriginalName(),
            'file_extension' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize()
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Store file in storage folder
        $path = $file->storeAs('public/'.$this->config['base_name'], $this->config['file_name']);
        // Save file into database
        $liste = new Liste;
        $liste->base_id = $this->config['base_id'];
        $liste->filename = $this->config['file_name'];  
        $liste->extension = $this->config['file_extension'];
        $liste->filesize = $this->config['file_size'];
        $liste->save();
    }
}
