<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Scooter;

class ScooterController extends Controller
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
        return view('scooters.index')->with('scooters', Scooter::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scooters.create');
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
            'kennzeichen' => 'required',
            'zulassung' => 'required',
        ]);


        $scooter = new Scooter;
        $scooter->kennzeichen = $request->input('title');
        $scooter->zulassung = $request->input('zulassung');



        $scooter->save();

        // auth()->user()->id for user id;

        return redirect('/scooters');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('scooter.show')->with('scooter', Scooter::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scooter = Scooter::find($id);

        //Check if scooter exists before deleting
        if (!isset($scooter)){
            return redirect('/scooters')->with('error', 'Not Found');
        }

        return view('scooter.edit')->with('scooter', $scooter);
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
            'kennzeichen' => 'required',
            'zulassung' => 'required',
        ]);

        $scooter = Scooter::find($id);

        if(!isset($scooter)) {
            $scooter = new Scooter;
        }

        $scooter->kennzeichen = $request->input('kennzeichen');
        $scooter->zulassung = $request->input('zulassung');

        $scooter->save();

        return redirect('/scooters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scooter = Scooter::find($id);

        //Check if post exists before deleting
        if (!isset($scooter)){
            return redirect('/scooters')->with('error', 'Not Found');
        }

        $scooter->delete();
        return redirect('/scooters');
    }
}
