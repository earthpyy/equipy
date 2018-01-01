<?php

namespace App\Http\Controllers;

use App\Lent;
use App\Borrower;
use App\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Display a listing of the resource which borrowed by someone.
     *
     * @param  App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function borrower(Borrower $borrower)
    {
        $datas = Lent::ofBorrower($borrower)->paginate(10);

        return view('lent.index')->with('borrower', $borrower)->with('datas', $datas);
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
     * Show the form for creating a new borrowing.
     *
     * @param  App\Borrower  $borrower = null
     * @return \Illuminate\Http\Response
     */
    public function borrow(Borrower $borrower = null)
    {
        return view('lent.borrow')->with('borrower', $borrower);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            // TODO: change student_id here
            'student_id' => 'nullable|digits:10',
            'telephone' => 'required|digits:10',
            'promising_date' => 'required|date|after_or_equal:today',

            'things' => 'required|array|min:1'
        ]);
        
        $borrower = Borrower::firstOrCreate([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'tel' => $request->telephone
        ]);

        $lent = new Lent;
        $lent->borrower_id = $borrower->id;
        $lent->note = $request->note;
        $lent->promising_date = $request->promising_date;
        $lent->approver_id = Auth::user()->id;
        $lent->save();

        foreach ($request->things as $thing_id) {
            $thing = Thing::find($thing_id);
            if ($thing != null && $thing->status == 'AVAILABLE') {
                $thing->status = 'OUTOFSTOCK';
                $thing->save();
                $lent->things()->save($thing, ['status' => 'NOTRETURN', 'return_date' => null]);
            }
        }

        return redirect('lent/' . $lent->id);
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
        return view('lent.edit')->with('lent', $lent);
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
        $request->validate([
            'name' => 'required|string|max:191',
            // TODO: change student_id here
            'student_id' => 'nullable|digits:10',
            'telephone' => 'required|digits:10',
            'promising_date' => 'required|date',

            // 'things' => 'required|array|min:1'
        ]);
        
        $borrower = Borrower::firstOrCreate([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'tel' => $request->telephone
        ]);

        // $lent = new Lent;
        $lent->borrower_id = $borrower->id;
        $lent->note = $request->note;
        $lent->promising_date = $request->promising_date;
        // $lent->approver_id = Auth::user()->id;
        // $lent->save();

        $completed = true;
        foreach ($request->things as $thingId => $status) {
            $oldThing = $lent->things()->find($thingId);
            $status = str_replace('WILL', '', $status);
            if ($oldThing->pivot->status != $status) {
                if ($oldThing->pivot->status == 'NOTRETURN') {
                    if ($status == 'RETURNED') {
                        $oldThing->status = 'AVAILABLE';
                    } else {
                        $oldThing->status = 'DEFECTIVE';
                    }
                    $oldThing->save();
                    $lent->things()->updateExistingPivot($thingId, ['status' => $status, 'return_date' => date('Y-m-d H:i:s')]);
                // } else {
                }
            } else if ($oldThing->pivot->status == 'NOTRETURN') {
                $completed = false;
            }
        }

        if ($completed) {
            $lent->completed_date = date('Y-m-d H:i:s');
        }
        $lent->save();

        return redirect('lent/' . $lent->id);
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
