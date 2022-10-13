<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //

    public function access_token(Request $request)
    {
        $proxy = Request::create('oauth/token', 'POST');
        return Route::dispatch($proxy);
    }

    public function refresh_token(Request $request)
    {
        $proxy = Request::create('oauth/token', 'POST');
        return Route::dispatch($proxy);
    }

    public function getUser($user_id = null)
    {
        if (isset($user_id)) {
            $user = User::find($user_id);
        } else {
            $user = auth()->user();
        }
        return response()->json([
            'message' => __('admin.success'),
            'items' => $user
        ], Response::HTTP_OK);
    }

    public function postUser(Request $request)
    {
        $user = new User();
        $validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('admin.error'),
                'items' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json([
            'message' => __('admin.success'),
        ], Response::HTTP_OK);
    }

    public function putUser(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => __('admin.error'),
                'items' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json([
            'message' => __('admin.success'),
        ], Response::HTTP_OK);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->get('user_id'));
        if (isset($user)) {
            $user->delete();
            return response()->json([
                'message' => __('admin.success'),
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => __('admin.error'),
        ], Response::HTTP_BAD_REQUEST);
    }
}
