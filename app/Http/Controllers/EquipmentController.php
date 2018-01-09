<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Category;
use Illuminate\Http\Request;

class EquipmentController extends Controller
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
        $datas = Equipment::paginate(10);
        return view('equipment.index')->with('sub', 'All')->with('datas', $datas);
    }

    /**
     * Display a listing of defective equipment.
     *
     * @return \Illuminate\Http\Response
     */
    public function defective()
    {
        $datas = Equipment::where('status', 'DEFECTIVE')->paginate(10);
        return view('equipment.index')->with('sub', 'Defective')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('equipment.create')->with('categories', $categories);
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
            'barcode' => 'required|digits:5|unique:equipment',
            'name' => 'required|string|min:3|max:191',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|string|min:3',
            'status' => 'required|in:AVAILABLE,DEFECTIVE'
        ]);
        
        Equipment::create([
            'barcode' => $request->barcode,
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return redirect('equipment/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('equipment.show')->with('equipment', $equipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $categories = Category::all();
        return view('equipment.edit')->with('equipment', $equipment)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'barcode' => 'required|digits:5|unique:equipment,barcode,' . $equipment->id,
            'name' => 'required|string|min:3|max:191',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|string|min:3',
            'status' => 'in:AVAILABLE,,DEFECTIVE'
        ]);
        
        $equipment->barcode = $request->barcode;
        $equipment->name = $request->name;
        $equipment->category_id = $request->category;
        $equipment->description = $request->description;
        if ($equipment->status != 'OUTOFSTOCK') {
            $equipment->status = $request->status;
        }
        $equipment->save();
        return redirect('equipment/' . $equipment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        if ($equipment->status != 'OUTOFSTOCK') {
            $equipment->delete();
        }
        return back();
    }

    /**
     * Return equipment's detail from barcode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        if($request->ajax())
        {
            $equipment = Equipment::with('category')->where('barcode', $request->barcode)->first();

            if ($equipment == NULL) {
                return "Invalid barcode!";
            } else if ($request->method == 'borrow') {
                if ($equipment->status == 'OUTOFSTOCK') {
                    return "This equipment is already borrowed!";
                } else if ($equipment->status == 'DEFECTIVE') {
                    return "This equipment is defective!";
                }
            } else {
                if ($equipment->status == 'AVAILABLE') {
                    return "This equipment is not borrowed yet!";
                } else if ($equipment->status == 'DEFECTIVE') {
                    return "Error!";
                }
            }

            return response()->json($equipment);
        }
    }
}
