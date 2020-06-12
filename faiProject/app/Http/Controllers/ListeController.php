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

  public function storeFile(Request $request){
    $file = $request->file('file');
    dd($file);
  }


  public function uploadEmail(){
    $emails = json_decode($_POST['emails']);
    if(!empty($emails)){
      dispatch(new ProcessMail($emails, Liste::max('id')))->onQueue('emails');
    }
    return;
  }
}
