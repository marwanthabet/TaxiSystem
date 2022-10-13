<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin($guard){
        return view('cms.auth.login', ['guard' => $guard]);
    }

    public function login(Request $request){
        $tableName = $request->input('guard') == 'admin' ? 'admins' : 'drivers';
        $validator = Validator($request->all(), [
            'guard' => 'required|in:admin,driver',
            'email' => "required|email|exists:$tableName,email",
            'password' => 'required|string|min:3',
            'remember' => 'boolean'
        ],[
            'guard.in' => 'Check login url'
        ]);
        $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
        if(!$validator->fails()){
            if(Auth::guard($request->input('guard'))->attempt($credentials, $request->input('remember'))){
                return response()->json([
                    'message' => 'logged in successfully'
                ], Response::HTTP_OK);
            }else{
                return response()->json([
                    'message' => 'Login failed!, check your credentials'
                ], Response::HTTP_BAD_REQUEST);
            }
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
        //return response()->json(['message' => 'Test Meassage'], Response::HTTP_BAD_REQUEST);
    }

    public function editProfile(Request $request){
        $guard = Auth::guard('admin')->check() ? 'admin' : 'driver';
        return response()->view('cms.auth.edit-profile', ['user' => auth($guard)->user()]);
    }

    public function updateProfile(Request $request){
        $guard = Auth::guard('admin')->check() ? 'admin' : 'driver';
        $tableName = $guard == 'admin' ? 'admins' : 'drivers';
        $validator = Validator($request->all(), [
            'email' => "required|string|email|unique:$tableName,email,".Auth::guard($guard)->id(),
            'name' => 'required|string|min:3|max:45'
        ]);
        if(!$validator->fails()){
            $user = auth($guard)->user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Profile updated successfully' : 'Profile update failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST); 
        }
    }

    public function editPassword(Request $request){
        return response()->view('cms.auth.change-password');
    }

    public function updatePassword(Request $request){
        $guard = Auth::guard('admin')->check() ? 'admin' : 'driver';
        $validator = Validator($request->all(), [
            'password' => "required|string|current_password:$guard",
            'new_password' => 'required|string|min:3|max:15|confirmed',
            'new_password_confirmation' => 'required|string|min:3|max:15',
        ]);
        if(!$validator->fails()){
            $user = auth($guard)->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'message' => $isSaved ? 'Password changed successfully' : 'Password change failed'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST); 
        }
    }

    public function logout(Request $request){
        $guard = Auth::guard('admin')->check() ? 'admin' : 'driver';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login', $guard);
    }
}
