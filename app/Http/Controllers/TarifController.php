<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tarif;

class TarifController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tarif.index')->with('tarifs', Tarif::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'preis' => 'required',
            'tarifart' => 'required',
            'leistungen' => 'required',
        ]);


        $tarif = new Tarif;
        $tarif->preis = $request->input('preis');
        $tarif->tarifart = $request->input('tarifart');
        $tarif->leistungen = $request->input('leistungen');

        $tarif->save();

        // auth()->user()->id for user id;

        return redirect('/tarifs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tarif.show')->with('tarif', Tarif::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarif = Tarif::find($id);

        //Check if tarif exists before deleting
        if (!isset($tarif)){
            return redirect('/tarifs')->with('error', 'Not Found');
        }

        return view('tarif.edit')->with('tarif', $tarif);
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
        $this->validate($request, [
            'preis' => 'required',
            'tarifart' => 'required',
            'leistungen' => 'required',
        ]);

        $tarif = Tarif::find($id);

        if(!isset($tarif)) {
            $tarif = new Tarif;
        }

        $tarif->preis = $request->input('preis');
        $tarif->tarifart = $request->input('tarifart');
        $tarif->leistungen = $request->input('leistungen');

        $tarif->save();

        return redirect('/tarifs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarif = Tarif::find($id);

        //Check if post exists before deleting
        if (!isset($tarif)){
            return redirect('/tarifs')->with('error', 'Not Found');
        }

        $tarif->delete();
        return redirect('/tarifs');
    }
}
