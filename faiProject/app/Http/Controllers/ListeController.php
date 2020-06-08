<?php

namespace App\Http\Controllers;

use \App\Destinataire;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessMail;
use Illuminate\Http\Request;

class ListeController extends Controller
{
  public function showUploadForm(){
      $bases = Base::all();
      return view('uploadlist', ["bases" => $bases]);
  }

  public function storeFile(Request $request){
    $emails = json_decode($_POST['emails']);
    foreach ($emails as $key => $mail) {
      $emailExist = Destinataire::where('email', $mail)->get()->toArray();
      if(empty($emailExist)){
        Destinataire::create([
          'list_id' => 1,
          'email' => $mail,
        ]);
      }
    }
    end($emails);
    if(key($emails) === 699){
      return $emails;
    }else{
      return false;
    }
  }
}
