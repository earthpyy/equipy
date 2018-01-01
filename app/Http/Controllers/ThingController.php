<?php

namespace App\Http\Controllers;

use App\Thing;
use App\Type;
use Illuminate\Http\Request;

class ThingController extends Controller
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
        $datas = Thing::paginate(10);
        return view('thing.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('thing.create')->with('types', $types);
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
            // TODO: change barcode type here
            'barcode' => 'required|digits:13|unique:things',
            'name' => 'required|string|min:3|max:191',
            'type' => 'required|exists:types,id',
            'description' => 'nullable|string|min:3',
            'status' => 'required|in:AVAILABLE,DEFECTIVE'
        ]);
        
        Thing::create([
            'barcode' => $request->barcode,
            'name' => $request->name,
            'type_id' => $request->type,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return redirect('thing/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function show(Thing $thing)
    {
        return view('thing.show')->with('thing', $thing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function edit(Thing $thing)
    {
        $types = Type::all();
        return view('thing.edit')->with('thing', $thing)->with('types', $types);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thing $thing)
    {
        $request->validate([
            // TODO: change barcode type here
            'barcode' => 'required|digits:13|unique:things,barcode,' . $thing->id,
            'name' => 'required|string|min:3|max:191',
            'type' => 'required|exists:types,id',
            'description' => 'nullable|string|min:3',
            'status' => 'in:AVAILABLE,,DEFECTIVE'
        ]);
        
        $thing->barcode = $request->barcode;
        $thing->name = $request->name;
        $thing->type_id = $request->type;
        $thing->description = $request->description;
        if ($thing->status != 'OUTOFSTOCK') {
            $thing->status = $request->status;
        }
        $thing->save();
        return redirect('thing/' . $thing->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thing $thing)
    {
        if ($thing->status != 'OUTOFSTOCK') {
            $thing->delete();
        }
        return redirect('thing');
    }

    /**
     * Return thing's detail from barcode.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        if($request->ajax())
        {
            $thing = Thing::with('type')->where('barcode', $request->barcode)->first();

            if ($thing == NULL) {
                return "Invalid barcode!";
            } else if ($request->method == 'borrow') {
                if ($thing->status == 'OUTOFSTOCK') {
                    return "This equipment is already borrowed!";
                } else if ($thing->status == 'DEFECTIVE') {
                    return "This equipment is defective!";
                }
            } else {
                if ($thing->status == 'AVAILABLE') {
                    return "This equipment is not borrowed yet!";
                } else if ($thing->status == 'DEFECTIVE') {
                    return "Error!";
                }
            }

            return response()->json($thing);
        }
    }
}
