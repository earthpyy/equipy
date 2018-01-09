<?php

namespace App\Http\Controllers;

use App\Borrowing;
use App\Borrower;
use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
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
        $datas = Borrowing::paginate(10);
        
        return view('borrowing.index')->with('sub', 'All')->with('datas', $datas);
    }

    /**
     * Display a listing of the resource which borrowed by someone.
     *
     * @param  App\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function borrower(Borrower $borrower)
    {
        $datas = Borrowing::ofBorrower($borrower)->paginate(10);

        return view('borrowing.index')->with('borrower', $borrower)->with('datas', $datas);
    }

    /**
     * Display a listing of the resource which is uncompleted.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUncompleted()
    {
        $datas = Borrowing::where('completed_date', null)->paginate(10);

        return view('borrowing.index')->with('sub', 'Uncompleted')->with('datas', $datas);
    }

    /**
     * Display a listing of the resource which is completed.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHistory()
    {
        $datas = Borrowing::where('completed_date', '!=', null)->paginate(10);

        return view('borrowing.index')->with('sub', 'Histories')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new borrowing.
     *
     * @param  App\Borrower  $borrower = null
     * @return \Illuminate\Http\Response
     */
    public function borrow(Borrower $borrower = null)
    {
        return view('borrowing.borrow')->with('borrower', $borrower);
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
            'promising_date' => 'required|date_format:d/m/Y|after_or_equal:today',

            'equipment' => 'required|array|min:1'
        ]);
        
        $borrower = Borrower::firstOrCreate([
            'name' => $request->name,
            'student_id' => $request->student_id,
            'tel' => $request->telephone
        ]);

        $borrowing = new Borrowing;
        $borrowing->borrower_id = $borrower->id;
        // $borrowing->note = $request->note;
        $borrowing->promising_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->promising_date)));
        $borrowing->approver_id = Auth::user()->id;
        $borrowing->save();

        foreach ($request->equipment as $equipment_id) {
            $equipment = Equipment::find($equipment_id);
            if ($equipment != null && $equipment->status == 'AVAILABLE') {
                $equipment->status = 'OUTOFSTOCK';
                $equipment->save();
                $borrowing->equipment()->save($equipment, ['status' => 'NOTRETURN', 'return_date' => null]);
            }
        }

        return redirect('borrowing/' . $borrowing->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function show(Borrowing $borrowing)
    {
        // $datas = $borrowing->equipment()->paginate(10);

        // return view('borrowing.show')->with('id', $borrowing->id)->with('datas', $datas);
        return view('borrowing.show')->with('borrowing', $borrowing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrowing $borrowing)
    {
        return view('borrowing.edit')->with('borrowing', $borrowing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            // 'name' => 'required|string|max:191',
            // TODO: change student_id here
            // 'student_id' => 'nullable|digits:10',
            // 'telephone' => 'required|digits:10',
            'promising_date' => 'required|date_format:d/m/Y|after_or_equal:today',

            // 'equipment' => 'required|array|min:1'
        ]);
        
        // $borrowing->borrower->name = $request->name;
        // $borrowing->borrower->student_id = $request->student_id;
        // $borrowing->borrower->tel = $request->telephone;
        // $borrowing->borrower->save();

        // $borrowing = new Borrowing;
        // $borrowing->borrower_id = $borrower->id;
        // $borrowing->note = $request->note;
        $borrowing->promising_date = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $request->promising_date)));
        // $borrowing->approver_id = Auth::user()->id;
        // $borrowing->save();

        $completed = true;
        foreach ($request->equipment as $equipmentId => $status) {
            $oldEquipment = $borrowing->equipment()->find($equipmentId);
            $status = str_replace('WILL', '', $status);
            if ($oldEquipment->pivot->status != $status) {
                if ($oldEquipment->pivot->status == 'NOTRETURN') {
                    if ($status == 'RETURNED') {
                        $oldEquipment->status = 'AVAILABLE';
                    } else {
                        $oldEquipment->status = 'DEFECTIVE';
                    }
                    $oldEquipment->save();
                    $borrowing->equipment()->updateExistingPivot($equipmentId, ['status' => $status, 'return_date' => date('Y-m-d H:i:s')]);
                // } else {
                }
            } else if ($oldEquipment->pivot->status == 'NOTRETURN') {
                $completed = false;
            }
        }

        if ($completed) {
            $borrowing->completed_date = date('Y-m-d H:i:s');
        }
        $borrowing->save();

        return redirect('borrowing/' . $borrowing->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Borrowing  $borrowing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrowing $borrowing)
    {
        $borrowing->equipment->each(function ($equipment) {
            if ($equipment->status == 'OUTOFSTOCK') {
                $equipment->status = 'AVAILABLE';
                $equipment->save();
            }
        });
        $borrowing->delete();

        return back();
    }
}
