<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class DriverPermissionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Driver $driver)
    {
        //
        $validator = Validator($request->all(), [
            'permission_id' => 'required|integer|exists:permissions,id'
        ]);
        if(! $validator->fails()){
            $permission = Permission::findById($request->input('permission_id'), 'driver');
            $message = '';
            if($driver->hasPermissionTo($permission)){
                $driver->revokePermissionTo($permission);
                $message = 'Permission revoked successfully';
            }else{
                $driver->givePermissionTo($permission);
                $message = 'Permission assigned successfully';
            }
            return response()->json([
                'message' => $message
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
        $permissions = Permission::where('guard_name', 'driver')->get();
        $driverPermissions = $driver->permissions;
        foreach($permissions as $permission){
            $permission->setAttribute('assigned', false);
            foreach($driverPermissions as $driverPermission){
                if($driverPermission->id == $permission->id){
                    $permission->setAttribute('assigned', true);
                }
            }
        }
        return response()->view('cms.drivers.driver-permissions', ['driver' => $driver, 'permissions' => $permissions]);
    }

}
