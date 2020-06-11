<?php

namespace App\Http\Controllers;

use \App\Destinataire;
use \App\Liste;
use \App\Base;
use \App\Jobs\ProcessMail;
use \App\Jobs\storeFileJob;
use \App\Event\NewMailHasRegisterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
session_start();
class ListeController extends Controller
{
  public function showUploadForm(){
      $bases = Base::all();
      return view('uploadlist', ["bases" => $bases]);
  }
    

  public function uploadEmail(Request $request){
    $emails = json_decode($_POST['emails']);
    $_SESSION['emails'] = $emails;
    return;
  }

  public function uploadInit(Request $request){
    if($request->has('file')){

      // Store file
      $base = Base::select('id', 'name')->where('name', $request->get('base'))->get()->toArray()[0];

      $this->storeFile($base, $request->file('file'));
    
      // Store emails into database
      dispatch(new ProcessMail($_SESSION['emails'], Liste::max('id')))->onQueue('emails');

      return redirect()->back();
    }else{
      return redirect()->back()->with('message', 'Error', "Error, file doesn't exist");
    }
  }

  public function storeFile($base, $file){

    $config = [
        'base_name' => $base['name'],
        'base_id' => $base['id'],
        'file_name' => $file->getClientOriginalName(),
        'file_extension' => $file->getClientOriginalExtension(),
        'file_size' => $file->getSize()
    ];

    $path = $file->storeAs('public/'.$config['base_name'], $config['file_name']);

    $liste = new Liste;
    $liste->base_id = $config['base_id'];
    $liste->filename = $config['file_name'];  
    $liste->extension = $config['file_extension'];
    $liste->filesize = $config['file_size'];
    $liste->save();
  }
}
