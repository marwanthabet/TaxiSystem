<?php

namespace App\Policies;

use App\Models\CarType;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  $id
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($id)
    {
        //
        $guard = '';
        if(auth('admin')->check()) $guard = 'admin'; 
        else if(auth('admin-api')->check()) $guard = 'admin-api'; 
        else $guard = 'driver';
        return auth($guard)->check() && auth($guard)->user()->hasPermissionTo('Read-Types') 
        ? $this->allow() : $this->deny('REJECTED');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $id
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($id, CarType $carType)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($id)
    {
        //
        return auth('admin')->check() && auth('admin')->user()->hasPermissionTo('Create-Type') 
        ? $this->allow() : $this->deny('REJECTED');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($id, CarType $carType)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($id, CarType $carType)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($id, CarType $carType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($id, CarType $carType)
    {
        //
    }
}
