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
    if(isset($emails)){
      end($emails);
      if(key($emails) == 39999){
        dispatch(new ProcessMail(json_decode($_POST['emails']), Liste::max('id')))->onQueue('emails');
        return true;
      }else{
        return false;
      }
    }
  }
}
