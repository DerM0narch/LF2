<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Hersteller;

class HerstellerController extends Controller
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
        return view('hersteller.index')->with('herstellers', Hersteller::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hersteller.create');
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
            'name' => 'required',
            'kontakt' => 'required',
        ]);


        $hersteller = new Hersteller;
        $hersteller->name = $request->input('name');
        $hersteller->kontakt = $request->input('kontakt');


        $hersteller->save();

        // auth()->user()->id for user id;

        return redirect('/herstellers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('hersteller.show')->with('hersteller', Hersteller::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hersteller = Hersteller::find($id);

        //Check if hersteller exists before deleting
        if (!isset($hersteller)){
            return redirect('/herstellers')->with('error', 'Not Found');
        }

        return view('hersteller.edit')->with('hersteller', $hersteller);
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
            'name' => 'required',
            'kontakt' => 'required',
        ]);

        $hersteller = Hersteller::find($id);

        if(!isset($hersteller)) {
            $hersteller = new Hersteller;
        }

        $hersteller->name = $request->input('name');
        $hersteller->kontakt = $request->input('kontakt');

        $hersteller->save();

        return redirect('/herstellers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hersteller = Hersteller::find($id);

        //Check if post exists before deleting
        if (!isset($hersteller)){
            return redirect('/herstellers')->with('error', 'Not Found');
        }

        $hersteller->delete();
        return redirect('/herstellers');
    }
}
