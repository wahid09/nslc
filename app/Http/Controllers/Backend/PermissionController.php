<?php

namespace App\Http\Controllers\Backend;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('permission-index');
        $permissions = Permission::all();
        return view('backend.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('permission-create');
        $modules = Module::all();
        return view('backend.permissions.form', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('permission-create');
        $this->validate($request, [
            'name' => 'required|string',
            'module' => 'required'
        ]);

        $permission = Permission::create([
            'module_id' => $request->module,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        notify()->success("Permission Added", "Success");

        //return redirect()->route('app.permissions.index');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        Gate::authorize('permission-index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        Gate::authorize('permission-update');
        $modules = Module::all();
        return view('backend.permissions.form', compact('modules', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        Gate::authorize('permission-update');
        $this->validate($request, [
            'name' => 'required|string',
            'module' => 'required'
        ]);

        $permission->update([
            'module_id' => $request->module,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        notify()->success("Permission Updated", "Success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        Gate::authorize('permission-delete');
        $permission->delete();
        notify()->success("Permission Deleted", "Success");
        return back();
    }
}
