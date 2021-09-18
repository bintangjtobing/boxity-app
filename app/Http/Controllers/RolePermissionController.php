<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class RolePermissionController extends Controller
{
    // GET DATA
    public function getPermissions() {
        $permissions = DB::table('permissions')->get()->all();
        return response()->json($permissions, 200);
    }
    
    public function getRolePermissions (Request $request) {
        $rolePermissions = DB::table('roles_permissions')
            ->join('roles', 'roles.id', '=', 'roles_permissions.role_id')
            ->join('permissions', 'permissions.id', '=', 'roles_permissions.permissions_id')
            ->select( 
                'roles.id as roleId',
                'roles.name as roleName',
                'roles.slug as roleSlug',
                'permissions.id as permissionId',
                'permissions.name as permissionName',
                'permissions.slug as permissionSlug',
              )
            ->get()->all();
        
        if ($request->isFormat) {
            $data = [];
            $rolePermission = []; $idTemp = []; 
            foreach ($rolePermissions as $value) {
                if (!in_array($value->roleId ,$idTemp)) {
                    $schema = [
                        "roleId" => $value->roleId,
                        "role" => $value->roleName,
                        "permissions" => []
                    ];
                    array_push($rolePermission, $schema);
                    array_push($idTemp, $value->roleId);
                }
            }
            foreach ($rolePermission as $value) {
                foreach ($rolePermissions as $rolePermissionsElm) {
                    if ($value['role'] === $rolePermissionsElm->roleName) {
                        $schemaPermission = [
                          "permissionId" => $rolePermissionsElm->permissionId,
                          "permission" => $rolePermissionsElm->permissionName
                        ];
                        array_push($value['permissions'], $schemaPermission);
                    }
                }
                array_push($data, $value);
            }
        }
        else {
            foreach ($rolePermissions as $value) {
                $value->IDpermission = $value->roleSlug . '.' . $value->permissionSlug;
            }
        }
        
        $data = $data ?? $rolePermissions;
        return response()->json($data, 200);
    }
    
    // ACTION
    public function insertRolePermission (Request $request) {
        $schema = $request->validate([
            'role' => ['required', 'string'],
            'permissions' => ['required', 'array'],
        ]);
        
        $roleQuery = [
            'name' => $schema['role'],
            'slug' => strtolower($schema['role'])
        ];
        $role = DB::table('roles')->insertGetId($roleQuery);
        
        foreach ($schema['permissions'] as $value) {
            $permissionQuery = [
                'name' => $value,
                'slug' => strtolower($value)
            ];
            $permission = DB::table('permissions')->insertGetId($permissionQuery);
            
            $rolesPermissionsQuery = [
                "role_id"  => $role,
                "permissions_id" => $permission
            ];
            DB::table('roles_permissions')->insert($rolesPermissionsQuery);
        }
        
        return response()->json($role, 200);
    }
    
    public function updateRolePermissions (Request $request) {
        $schema = $request->validate([
            'roleId' => ['required', 'integer'],
            'role' => ['required', 'string'],
            'permissions' => ['required', 'array']
        ]);
        
        $roleQuery = [
            'name' => $schema['role'],
            'slug' => strtolower($schema['role'])
        ];
        $role = DB::table('roles')->where('id', $schema['roleId'])->update($roleQuery);
        
        $permissionsId = [];
        foreach ($schema['permissions'] as $value) {
            $permissionQuery = [
                'name' => $value['permission'],
                'slug' => strtolower($value['permission'])
            ];
            DB::table('permissions')->where('id', $value['permissionId'])->update($permissionQuery);
            array_push($permissionsId, $value['permissionId']);
        }
        
        $dataPermissionId = DB::table('roles_permissions')->where('role_id', $schema['roleId'])->select('permissions_id')->get()->all();
        
        foreach ($dataPermissionId as $value) {
            if(!in_array($value->permissions_id, $permissionsId)) {
                DB::table('permissions')->where('id', $value->permissions_id)->delete();
                DB::table('roles_permissions')->where('permissions_id', $value->permissions_id)->delete();
            }
        }
        
        foreach ($schema['permissions'] as $value) {
            if ($value['permissionId'] == 0) {
                $permissionQuery = [
                    'name' => $value['permission'],
                    'slug' => strtolower($value['permission'])
                ];
                $cretePermissionId = DB::table('permissions')->insertGetId($permissionQuery);
                
                $rolesPermissionsQuery = [
                    "role_id"  => $schema['roleId'],
                    "permissions_id" => $cretePermissionId
                ];
                DB::table('roles_permissions')->insert($rolesPermissionsQuery);
            }
        }
        
        return response()->json($role, 200);
    }
    
    public function deleteRolePermissions ($roleId) {
        $dataPermissionId = DB::table('roles_permissions')->where('role_id', $roleId)->select('permissions_id')->get()->all();
        foreach ($dataPermissionId as $value) {
            DB::table('permissions')->where('id', $value->permissions_id)->delete();
        }
        
        DB::table('roles')->where('id', $roleId)->delete();
        $result = DB::table('roles_permissions')->where('role_id', $roleId)->delete();
        return response()->json($result, 200);
    }
}
