<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
	/**
	 * Display a listing of all permissions
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$permissions = Permission::all();

		return view('admin.permissions', [
			'permissions' => $permissions
		]);
	}

	/**
	 * Show form for creating a new permission
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.permission.create');
	}

	/**
	 * Store a newly created permission in storage
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|unique:users,name'
		]);
		Permission::create($request->only('name'));

		return redirect()->route('admin.permissions')
			->withSuccess(__('Permission created successfully.'));
	}

	// /**
	//  * Display the specified permission
	//  *
	//  * @param  \Spatie\Permission\Models\Permission  $permission
	//  * @return \Illuminate\Http\Response
	//  */
	// public function show(Permission $permission)
	// {
	//     //
	// }

	/**
	 * Show the form for editing the specified permission
	 *
	 * @param  \Spatie\Permission\Models\Permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Permission $permission)
	{
		return view('admin.permission.edit', [
			'permission' => $permission
		]);
	}

	/**
	 * Update the specified permission in storage
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Spatie\Permission\Models\Permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Permission $permission)
	{
		$request->validate([
			'name' => 'required|unique:permissions,name,'.$permission->id
		]);
		$permission->update($request->only('name'));

		return redirect()->route('admin.permissions')
			->withSuccess(__('Permission updated successfully.'));
	}

	/**
	 * Remove the specified permission from storage
	 *
	 * @param  \Spatie\Permission\Models\Permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Permission $permission)
	{
		$permission->delete();

		return redirect()->route('admin.permissions')
			->withSuccess(__('Permission deleted successfully.'));
	}
}
