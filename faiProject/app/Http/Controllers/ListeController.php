<?php

namespace App\Http\Controllers;

use \App\Destinataire;
use \App\Liste;
use \App\Base;
use \App\Jobs\ProcessMail;
use \App\Event\NewMailHasRegisterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListeController extends Controller
{
  public function showUploadForm(){
      $bases = Base::all();
      return view('uploadlist', ["bases" => $bases]);
  }

  public function uploadEmail(Request $request){
    ProcessMail::dispatch(json_decode($_POST['emails']))->onQueue('default');
  }

  public function storeFile(Request $request){
   
    if($request->has('file')){
      $base = Base::select('id', 'name')->where('name', $request->get('base'))->get()->toArray()[0];
      $config = [
        'base_name' => $base['name'],
        'base_id' => $base['id'],
        'file_name' => $request->file('file')->getClientOriginalName(),
        'file_extension' => $request->file('file')->getClientOriginalExtension(),
        'file_size' => $request->file('file')->getSize()
      ];
      // Store file in storage folder
      $path = $request->file('file')->storeAs('public/'.$config['base_name'], $config['file_name']);
      // Save file into database
      $liste = new Liste;
      $liste->base_id = $config['base_id'];
      $liste->filename = $config['file_name'];  
      $liste->extension = $config['file_extension'];
      $liste->filesize = $config['file_size'];
      $liste->save();
    }
  }
}
