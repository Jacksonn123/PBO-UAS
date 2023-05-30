<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use PDF;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('asset.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('asset.create');
    }

    public function getAssets(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('assets')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="' . route('assets.edit', $row->id) . '" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete Asset" onclick="hapus('.$row->id.')" >Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $response = [
            'draw' => 0,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
            'input' => [],
        ];

        return json_encode($response);
    }

    public function getAssetsOn(Request $request)
    {
        if ($request->ajax()) {
            $today = Carbon::now();
            $data = DB::table('assets')->where('life_time', '>', $today)->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $response = [
            'draw' => 0,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
            'input' => [],
        ];

        return json_encode($response);
    }

    public function getAssetsOver(Request $request)
    {
        if ($request->ajax()) {
            $today = Carbon::now();
            $data = DB::table('assets')->where('life_time', '<', $today)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $response = [
            'draw' => 0,
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => [],
            'input' => [],
        ];

        return json_encode($response);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'asset_no' => 'required|unique:assets,asset_no',
            'description' => 'required',
            'acquisition' => 'required',
            'document' => 'required',
            'serial_no' => 'required',
            'price' => 'required',
            'tax_date_line' => 'required',
            'tax_price' => 'required',
            'wto_date_line' => 'required',
            'wto_price' => 'required',
            'life_time' => 'required',
            'depreciation' => 'required',
            'location_of_document' => 'required',
            'location_of_asset' => 'required',
            'size' => 'required',
            'unit' => 'required',
            'condition' => 'required',
            'responsible_person' => 'required',
            'remarks' => 'required',
            'kategori' => 'required'
        ]);

        $asset = new Assets();
        $asset->asset_no = $request->asset_no;
        $asset->description = $request->description;
        $asset->acquisition = $request->acquisition;
        $asset->document = $request->document;
        $asset->serial_no = $request->serial_no;
        $asset->price = $request->price;
        $asset->tax_date_line = $request->tax_date_line;
        $asset->tax_price = $request->tax_price;
        $asset->wto_date_line = $request->wto_date_line;
        $asset->wto_price = $request->wto_price;
        $asset->life_time = $request->life_time;
        $asset->depreciation = $request->depreciation;
        $asset->location_of_document = $request->location_of_document;
        $asset->location_of_asset = $request->location_of_asset;
        $asset->size = $request->size;
        $asset->unit = $request->unit;
        $asset->condition = $request->condition;
        $asset->responsible_person = $request->responsible_person;
        $asset->remarks = $request->remarks;
        $asset->kategori = $request->kategori;
        $asset->save();

        return redirect()->route('assets.index')
        ->with('success','Asset created successfully');

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
    public function edit(string $id): View
    {
        $data = Assets::find($id);
        return view('asset.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'acquisition' => 'required',
            'document' => 'required',
            'serial_no' => 'required',
            'price' => 'required',
            'tax_date_line' => 'required',
            'tax_price' => 'required',
            'wto_date_line' => 'required',
            'wto_price' => 'required',
            'life_time' => 'required',
            'depreciation' => 'required',
            'location_of_document' => 'required',
            'location_of_asset' => 'required',
            'size' => 'required',
            'unit' => 'required',
            'condition' => 'required',
            'responsible_person' => 'required',
            'remarks' => 'required',
            'kategori' => 'required'
        ]);

        $asset = Assets::find($id);
        $asset->description = $request->description;
        $asset->acquisition = $request->acquisition;
        $asset->document = $request->document;
        $asset->serial_no = $request->serial_no;
        $asset->price = $request->price;
        $asset->tax_date_line = $request->tax_date_line;
        $asset->tax_price = $request->tax_price;
        $asset->wto_date_line = $request->wto_date_line;
        $asset->wto_price = $request->wto_price;
        $asset->life_time = $request->life_time;
        $asset->depreciation = $request->depreciation;
        $asset->location_of_document = $request->location_of_document;
        $asset->location_of_asset = $request->location_of_asset;
        $asset->size = $request->size;
        $asset->unit = $request->unit;
        $asset->condition = $request->condition;
        $asset->responsible_person = $request->responsible_person;
        $asset->remarks = $request->remarks;
        $asset->kategori = $request->kategori;
        $asset->save();

        return redirect()->route('assets.index')
        ->with('success','Asset updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Assets::find($id)->delete();
    }

    public function printTable(Request $request) {
        $assets = json_decode($request->assets, true);
        $data = [
            'assets' => $assets
        ];

        $pdf = PDF::loadView('tableView', $data);

        $pdf->setPaper('A4', 'landscape');

        $pdf->setOption('enable-local-file-access', true);

        return $pdf->stream('assets.pdf');

    }

}
