<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DestinataireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bases = \App\Base::all();
        $destinataires = \App\Destinataire::take(5);
        return view('destinataires.index');
        // 
        // return view('destinataires.create', ["bases" => $bases, "destinataires" => $destinataires]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bases = \App\Base::all();
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
        $destinataires = \App\Destinataire::select('destinataires.id', 'destinataires.email')->join('listes', 'listes.id', '=', 'destinataires.list_id')->join('bases', 'bases.id', '=', 'listes.base_id')->where('bases.name', $baseName)->get();
        return view('destinataires.edit', ["baseName" => $baseName, "destinataires" => $destinataires]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        \App\Destinataire::find($id)->update($request->all());

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

        \App\Destinataire::find($id)->delete();
        return redirect('/destinataire/'.$request->get('destiname'));
    }
}
