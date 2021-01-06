<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Standort;

class StandortController extends Controller
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
        return view('standort.index')->with('standorts', Standort::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('standort.create');
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
            'ort' => 'required',
            'strasse' => 'required',
            'plz' => 'required',
        ]);


        $standort = new Standort;
        $standort->ort = $request->input('ort');
        $standort->strasse = $request->input('strasse');
        $standort->plz = $request->input('plz');

        $standort->save();

        // auth()->user()->id for user id;

        return redirect('/standorts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('standort.show')->with('standort', Standort::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $standort = Standort::find($id);

        //Check if standort exists before deleting
        if (!isset($standort)){
            return redirect('/standorts')->with('error', 'Not Found');
        }

        return view('standort.edit')->with('standort', $standort);
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
            'ort' => 'required',
            'strasse' => 'required',
            'plz' => 'required',
        ]);

        $standort = Standort::find($id);

        if(!isset($standort)) {
            $standort = new Standort;
        }

        $standort->ort = $request->input('ort');
        $standort->strasse = $request->input('strasse');
        $standort->plz = $request->input('plz');

        $standort->save();

        return redirect('/standorts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $standort = Standort::find($id);

        //Check if post exists before deleting
        if (!isset($standort)){
            return redirect('/standorts')->with('error', 'Not Found');
        }

        $standort->delete();
        return redirect('/standorts');
    }
}
