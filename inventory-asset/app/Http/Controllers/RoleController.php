<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('role.index');
    }

    public function getRoles(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role_name', function (Role $role) {
                    return $role->pluck('name')->implode(',');
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('roles.edit', $row->id) . '" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete Role" onclick="hapus('.$row->id.')" >Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        return view('role.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        $role = new Role;
        $role->name = $request->name;
        $save = $role->save();

        $role->givePermissionTo(Permission::all());
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    public function edit($id): View
    {

        $data = Role::find($id);
        return view('role.edit',compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name,'.$id,
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $save = $role->save();

        $role->givePermissionTo(Permission::all());
            
        return redirect()->route('roles.index')->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        Role::find($id)->delete();
    }
}
