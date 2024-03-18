<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedUser = Auth::user();
        
        $limit = config('constants.pagination_page_limit');

        $thismodel = Role::orderBy('id', 'asc');
       
        $thismodel->where('role_type', 'Staff');
        $roles = $thismodel->paginate($limit);

        return view('Admin.roles.index', compact('roles'))->with('i', (request()->input('page', 1) - 1) * $limit);
      
    }
    
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50', Rule::unique('roles', 'name')],
            'status' => ['nullable', 'numeric'],
        ]);

        if(empty($attributes['status'])){
            $attributes['status'] = 0;
        }
        $attributes['role_type'] = 'Staff';
        
        Role::create($attributes);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('Admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('Admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50', Rule::unique('roles', 'name')->ignore($role->id)],
            'status' => ['nullable', 'numeric'],
        ]);


        $role->update($attributes);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        Session::flash('error', 'Deleted ! ');
        return redirect()->route('admin.roles.index');
            
           

    }

    public function changeStatus(Request $request)
    {
        $role = Role::find($request->id)->update(['status' => $request->status]);
        return response()->json(['success' => 'Status changed successfully.']);
    }
}
