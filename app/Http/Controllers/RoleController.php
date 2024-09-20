<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtém o usuário autenticado
        $authUser = auth()->user();

        // Verifica se o usuário autenticado tem uma empresa associada
        if (!$authUser->company_id) {
            return redirect()->back()->withErrors('User is not associated with any company.');
        }

        // Obtém todas as roles
        $roles = Role::all();

        return view('admin.role-permission.role.index', [
            'roles' => $roles
        ]);

    }

    // public function index_()
    // {
    //     // Obtém o usuário autenticado
    //     $authUser = auth()->user();

    //     // Verifica se o usuário autenticado tem uma empresa associada
    //     if (!$authUser->company_id) {
    //         return redirect()->back()->withErrors('User is not associated with any company.');
    //     }

    //     // Obtém todas as roles ou filtra com base na empresa, se necessário
    //     // Condição no WhereHas: A consulta whereHas limita os resultados para roles que têm 
    //    // usuários associados com uma empresa específica. Se você deseja listar todas as roles
    //     // independentemente da associação com a empresa, você pode remover ou ajustar o filtro.
    //     $roles = Role::whereHas('users', function ($query) use ($authUser) {
    //         $query->where('company_id', $authUser->company_id);
    //     })->get();

    //     return view('role-permission.role.index', [
    //         'roles' => $roles
    //     ]);
    // }

    public function create()
    {
        return view('admin.role-permission.role.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role Created Successfully');
    }


    public function edit(Role $role)
    {
        return view('admin.role-permission.role.edit', [
            'role' => $role
        ]);
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role Updated Successfully');
    }


    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();

        return redirect('roles')->with('status', 'Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admin.role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }


    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status', 'Permissions add to role');
    }


}
