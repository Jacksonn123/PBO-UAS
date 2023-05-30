<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Assets::all();
        return view('locations.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getLocations(Request $request)
    {
        if ($request->ajax()) {
            $data = Locations::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('locations.edit', $row->id) . '" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete Asset" onclick="hapus('.$row->id.')" >Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'asset_no' => 'required',
            'location' => 'required',
        ]);

        $loc = new Locations();
        $loc->asset_no = $request->asset_no;
        $loc->location = $request->location;
        $loc->save();

        return redirect()->route('locations.index')
        ->with('success','Locations added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Locations::find($id);
        $assets = Assets::all();

        return view('locations.edit',compact('data','assets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'asset_no' => 'required',
            'location' => 'required',
        ]);

        $loc = Locations::find($id);
        $loc->asset_no = $request->asset_no;
        $loc->location = $request->location;
        $loc->save();

        return redirect()->route('locations.index')->with('success','Location updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Locations::find($id)->delete();
    }
}
