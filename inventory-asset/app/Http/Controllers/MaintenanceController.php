<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Maintenances;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('maintenance.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Assets::all();
        return view('maintenance.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getMaintenances(Request $request)
    {
        if ($request->ajax()) {
            $data = Maintenances::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete Asset" onclick="hapus('.$row->id.')" >Delete</a>';
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
            'info' => 'required',
        ]);

        $maintenance = new Maintenances();
        $maintenance->asset_no = $request->asset_no;
        $maintenance->info = $request->info;
        $maintenance->save();

        return redirect()->route('maintenances.index')
        ->with('success','Maintenance added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Maintenances::find($id)->delete();
    }
}
