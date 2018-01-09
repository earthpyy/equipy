<?php

namespace App\Http\Controllers;

use App\Borrower;
use App\Borrowing;
use Illuminate\Http\Request;

class BorrowerController extends Controller
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
    public function index(Request $request)
    {
        // if ($request->query('q') != null) {
            $datas = Borrower::search($request->query('q', ''))->paginate(10);
        // } else {
        //     $datas = Borrower::paginate(10);
        // }
        // $datas = Borrower::paginate(10);

        return view('borrower.index')->with('datas', $datas);
    }

    public function search(Request $request)
    {
        $datas = Borrower::search($request->query('q', ''))->paginate(10);

        return redirect('borrower.index')->with('datas', $datas);
    }

    /**
     * Return all borrower.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        if ($request->ajax()) {
            $borrowers = Borrower::all();
            return response()->json($borrowers);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    // public function show(Borrower $borrower)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrower $borrower)
    {
        return view('borrower.edit')->with('borrower', $borrower);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrower $borrower)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'student_id' => 'nullable|digits:10',
            'telephone' => 'required|digits:10'
        ]);
        
        $borrower->name = $request->name;
        $borrower->student_id = $request->student_id;
        $borrower->tel = $request->telephone;
        $borrower->save();
        
        return redirect('borrower');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrower $borrower)
    {
        //
    }
}
