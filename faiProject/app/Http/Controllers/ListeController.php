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

  public function storeFile(Request $request){
    if($request->has('file')){
      // Store file
      $base = Base::select('id', 'name')->where('name', $request->get('base'))->get()->toArray()[0];
      dispatch(new storeFileJob($base, $request->file('file')))->onQueue('storeFile');
      // Store emails into database
      dispatch(new ProcessMail($_SESSION['emails'], Liste::max('id')))->onQueue('emails');
      return redirect()->back();
    }else{
      return redirect()->back()->with('message', 'Error', "Error, file doesn't exist");
    }

  }
}
