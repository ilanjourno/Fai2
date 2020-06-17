<?php

namespace App\Http\Controllers;

use \App\Destinataire,
    \App\Liste,
    \App\Base;
use Validator;
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
    if($request->ajax()){
      $baseName = $request->get('base');
      $base_id = Base::where('name', $baseName)->get('id')->toArray()[0]['id'];
      $fileType = $_FILES['file']['type'];
      $fileName = basename($_FILES['file']['name']);
      $fileSize = $_FILES['file']['size'];
      // J'enregistre le fichier dans le folder storage/app/public/bases/{leNomDeLaBase}/{leNomDuFichier}
      $path = $request->file('file')->storeAs('public/bases'.$baseName, $fileName);
      $array = [
          'base_id' => $base_id,
          'filename' => $fileName,
          'extension' =>  $fileType,
          'filesize' => $fileSize
      ];
      Liste::insertOrIgnore($array);
      return true;
    }
  }


  public function uploadEmail(){
    $emails = json_decode($_POST['emails']);
    if(!empty($emails)){
      dispatch(new ProcessMail($emails, Liste::max('id'), Liste::latest('id')->first()->base_id))->onQueue('emails');
    }
    return;
  }
}
