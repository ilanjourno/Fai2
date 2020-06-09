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
        $array[] = [
          'email' => $mail,
          'list_id' => 1
        ];
    }
    Destinataire::insertOrIgnore($array);
    end($emails);
    if(key($emails) === 30000-1){
      return $emails;
    }else{
      return false;
    }
  }
}
