<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('destinataires.bases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \App\Base::create([
              'name' => $request->get('name')
        ]);
        return redirect() ->back()->with('success', 'Your base as been create successfully!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $base_id = \App\Base::where('name', $id)->get('id')->toArray()[0]['id'];

        $list_id = \App\Liste::where('base_id', $base_id)->get('id')->toArray()[0]['id'];

        \App\Base::where('name', $id)->delete();
        
        \App\Liste::where('base_id', $base_id)->delete();
        
        \App\Destinataire::where('list_id', $list_id)->delete();

        return redirect('/destinataire');
    }
}
