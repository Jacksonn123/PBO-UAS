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
use Hash;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function getAdmins(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function (User $user) {
                    return $user->roles->pluck('name')->implode(',');
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="' . route('admins.edit', $row->id) . '" data-id="'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete Admin" onclick="hapus('.$row->id.')" >Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create(): View
    {
        $roles =  Role::all();
        return view('admin.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone_number' => 'required',
            'admin_id' => 'required',
            'role' => 'required'
        ]);

        $admin = new User;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->admin_id = $request->admin_id;
        $admin->password = Hash::make($request->password);
        $admin->phone_number = $request->phone_number;
        $admin->created_by = \Auth::user()->id;
        $admin->updated_by = \Auth::user()->id;
        $save = $admin->save();

        $admin->assignRole($request->role);

        return redirect()->route('admins.index')
                        ->with('success','Admin created successfully');
    }

    public function edit($id): View
    {

        $data = User::find($id);
        $roles = Role::all();

        return view('admin.edit',compact('data','roles'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_number' => 'required',
            'admin_id' => 'required',
            'role' => 'required'
        ]);

        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->admin_id = $request->admin_id;
        if(!empty($request->password)){
            $admin->password = Hash::make($request->password);
        }
        $admin->phone_number = $request->phone_number;
        $admin->updated_by = \Auth::user()->id;
        $save = $admin->save();

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $admin->assignRole($request->role);

        return redirect()->route('admins.index')->with('success','Admin updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
