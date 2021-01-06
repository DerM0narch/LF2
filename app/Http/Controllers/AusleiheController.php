<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Ausleihe;

class AusleiheController extends Controller
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
        return view('ausleihe.index')->with('ausleihes', Ausleihe::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ausleihe.create');
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
            'leihende' => 'required',
            'leihstart' => 'required',
            'gesamtpreis' => 'required',
        ]);


        $ausleihe = new Ausleihe;
        $ausleihe->leihende = $request->input('leihende');
        $ausleihe->leihstart = $request->input('leihstart');
        $ausleihe->gesamtpreis = $request->input('gesamtpreis');
        //TODO Foreign Key?

        $ausleihe->save();

        // auth()->user()->id for user id;

        return redirect('/ausleihes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('ausleihe.show')->with('ausleihe', Ausleihe::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ausleihe = Ausleihe::find($id);

        //Check if ausleihe exists before deleting
        if (!isset($ausleihe)){
            return redirect('/ausleihes')->with('error', 'Not Found');
        }

        return view('ausleihe.edit')->with('ausleihe', $ausleihe);
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
            'leihende' => 'required',
            'leihstart' => 'required',
            'gesamtpreis' => 'required',
        ]);

        $ausleihe = Ausleihe::find($id);

        if(!isset($ausleihe)) {
            $ausleihe = new Ausleihe;
        }

        $ausleihe->leihende = $request->input('leihende');
        $ausleihe->leihstart = $request->input('leihstart');
        $ausleihe->gesamtpreis = $request->input('gesamtpreis');

        $ausleihe->save();

        return redirect('/ausleihes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ausleihe = Ausleihe::find($id);

        //Check if post exists before deleting
        if (!isset($ausleihe)){
            return redirect('/ausleihes')->with('error', 'Not Found');
        }

        $ausleihe->delete();
        return redirect('/ausleihes');
    }
}
