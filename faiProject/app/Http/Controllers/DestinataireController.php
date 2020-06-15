<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use \App\Destinataire,
    \App\Base,
    \App\Liste,
    Illuminate\Support\Facades\DB;
class DestinataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Base::query();
            return DataTables::of($data)->make(true);
        }
        return view('destinataires.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bases = Base::all();
        return view('destinataires.create', ['bases' => $bases]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($baseName)
    {
        return view('destinataires.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request){

        if($request->ajax()){
            $data = Destinataire::query()->join('listes', 'listes.id', '=', 'destinataires.list_id')->join('bases', 'bases.id', '=', 'listes.base_id')->where('bases.id', $_POST['id']);
            return DataTables::of($data)->make(true);
        }
        return view('destinataires.list');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($request->ajax()){
            $data = Liste::join('bases', 'bases.id', '=', 'listes.base_id')->where('bases.name', $baseName);
            return DataTables::of($data)->make(true);
        }
        return view('destinataires.list');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Destinataire::find($id)->update($request->all());

        return redirect('/destinataire/'.$request->get('destiName'));
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        Destinataire::find($id)->delete();
        return redirect('/destinataire/'.$request->get('destiname'));
    }

}
