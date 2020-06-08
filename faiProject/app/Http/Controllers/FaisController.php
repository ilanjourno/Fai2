<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fais = \App\Fais::all();
        $domains = \App\FaisDomains::all();
        return view('fais.index',  ['fais' => $fais, 'domains' => $domains]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!\App\Fais::where('name', $request->get('name'))->get()->toArray()){
            \App\Fais::create([
                'name' => $request->get('name')
            ]);
            $id = \App\Fais::lastFaisId();
            foreach (explode(', ', $request->get('domains')) as $key => $value) {
                \App\FaisDomains::create([
                    'fais_id' => $id,
                    'domains' => $value
                ]);
            }
            return redirect('/fais');
        }else{
            return redirect('/fais/create')->with('message', 'Error', 'Fai already exist');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($faisName)
    {
        $domains = \App\FaisDomains::select("fais_domains.domains", "fais_domains.id")->join('fais', 'fais.id', '=', 'fais_domains.fais_id')->where("fais.name", $faisName)->get();
        return view('fais.edit', ['fai' => $faisName, 'domains' => $domains]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($faiName)
    {
        $domain = \App\FaisDomains::join('fais', 'fais.id', '=', 'fais_domains.fais_id')->where('fais.name', $faiName);
        $fai = \App\Fais::where('name', $faiName);
        $domain->delete();
        $fai->delete();
        return redirect('/fais');
    }
}
