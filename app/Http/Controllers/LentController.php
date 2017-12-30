<?php

namespace App\Http\Controllers;

use App\Lent;
use Illuminate\Http\Request;

class LentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Lent::paginate(10);
        
        return view('lent.index')->with('datas', $datas);
    }

    /**
     * Display a listing of the resource which is uncompleted.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUncompleted()
    {
        $datas = Lent::where('completed_date', null)->paginate(10);

        return view('lent.index')->with('sub', 'Uncompleted')->with('datas', $datas);
    }

    /**
     * Display a listing of the resource which is completed.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHistory()
    {
        $datas = Lent::where('completed_date', '!=', null)->paginate(10);

        return view('lent.index')->with('sub', 'History')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new borrowing.
     *
     * @return \Illuminate\Http\Response
     */
    public function borrow()
    {
        return view('lent.borrow');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lent  $lent
     * @return \Illuminate\Http\Response
     */
    public function show(Lent $lent)
    {
        // $datas = $lent->things()->paginate(10);

        // return view('lent.show')->with('id', $lent->id)->with('datas', $datas);
        return view('lent.show')->with('lent', $lent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lent  $lent
     * @return \Illuminate\Http\Response
     */
    public function edit(Lent $lent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lent  $lent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lent $lent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lent  $lent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lent $lent)
    {
        //
    }
}
