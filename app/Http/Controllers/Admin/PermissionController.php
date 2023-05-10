<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(5);
        return view('admin.permissions.index' , compact('permissions'));
    }
    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'display_name'=>'required'
        ]);
        Permission::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'guard_name'=>'web'
        ]);

        alert()->success('با موفقیت انجام شد','پرمیژن با موفقیت اضافه شد');
        return redirect()->route('Admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('Admin.permissions.edit' , compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {

        $request->validate([
            'name'=>'required',
            'display_name'=>'required'
        ]);

        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'guard_name'=>'web'
        ]);

        alert()->success('با موفقیت انجام شد','پرمیژن با موفقیت ویرایش شد');
        return redirect()->route('Admin.permissions.index');
    }
}
