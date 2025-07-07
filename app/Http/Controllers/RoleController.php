<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
	{
		$roles = Role::all();
		return view('role.index', compact('roles'));
	}

	public function create()
	{
		return view('role.create');
	}

	public function store(Request $request)
	{
		// validation
		$request->validate([
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
		]);

		Role::create($request->all());
		return redirect()->route('role.index')->with('success', 'Role created successfully');
	}

	public function edit(Role $role)
	{
		return view('role.edit', compact('role'));
	}

	public function update(Request $request, Role $role)
	{
		// validation
		$request->validate([
			'title' => 'required|string|max:255',
			'description' => 'nullable|string',
		]);

		$role->update($request->all());
		return redirect()->route('role.index')->with('success', 'Role updated successfully');
	}

	public function destroy(Role $role)
	{
		$role->delete();
		return redirect()->route('role.index')->with('success', 'Role deleted successfully');
	}
}
