<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Dotenv\Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:3|max:30'
        ]);
        if (!$validator->fails()) {
            $admin = Admin::where('email', '=', $request->input('email'))->first();
            if (Hash::check($request->input('password'), $admin->password)) {
                $token = $admin->createToken('API-Admin');
                $admin->setAttribute('token', $token->accessToken);
                return response()->json([
                    'message' => 'Logged in successfully',
                    'token' => $admin
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'Login failed, check email & password'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $revoked = $token->revoke();
        return response()->json([
            'status' => $revoked,
            'message' => $revoked ? 'Logged out successfully' : 'Failed to logout!'
        ], $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function loginPGCT(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:3|max:30'
        ]);
        if (!$validator->fails()) {
            return $this->generatePGCT($request);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    private function generatePGCT(Request $request)
    {
        try {
            //code...
            $response = Http::asForm()->post('http://127.0.0.1:81/oauth/token', [
                'grant_type' => 'password',
                'client_id' => '3',
                'client_secret' => 'pCfxvAKRIYQkF2ULWnAh5uRSKjGeuFvCfuYkAvch',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '*'
            ]);
            $decodedResponse = json_decode($response);
            $admin = Admin::where('email', '=', $request->input('email'))->first();
            $admin->setAttribute('token', $decodedResponse->access_token);
            return response()->json([
                'status' => true,
                'message' => 'Logged in successfully',
                'token' => $admin
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => json_decode($response)->message,
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string|min:3|max:20'
        ]);

        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $isSaved = $admin->save();
            // if ($isSaved) $admin->assignRole(Role::findByName('Admin Api', 'admin-api'));
            return response()->json([
                'message' => $isSaved ? 'Registered successfully' : 'Registration failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|email|exists:admins,email'
        ]);
        if (!$validator->fails()) {
            $admin = Admin::where('email', '=', $request->input('email'))->first();
            $randomNumber = random_int(1000, 9999);
            $admin->auth_code = Hash::make($randomNumber);
            $isSaved = $admin->save();
            return response()->json([
                'message' => $isSaved ? 'Reset code sent successfully' : 'reset failed!', 'code' => $randomNumber
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|string|email|exists:admins,email',
            'code' => 'required|numeric|digits:4',
            'password' => 'required|string|min:3|max:15|confirmed'
        ]);
        if (!$validator->fails()) {
            $admin = Admin::where('email', '=', $request->input('email'))->first();
            if (!is_null($admin->auth_code)) {
                if (Hash::check($request->input('code'), $admin->auth_code)) {
                    $admin->password = Hash::make($request->input('password'));
                    $admin->auth_code = null;
                    $isSaved = $admin->save();
                    return response()->json([
                        'message' => $isSaved ? 'Reset password success' : 'Failed to reset password!'
                    ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
                } else {
                    return response()->json([
                        'message' => 'Password reset code error, try again'
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'message' => 'No gorget password request exist, process denied!'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    private function revokePreviousTokens($userId)
    {
        DB::table('oauth_access_tokens')
            ->where('user_id', '=', $userId)
            ->update(['revoked' => true]);
    }

    public function checkActiveTokens($userId): bool
    {
        return DB::table('oauth_access_tokens')
            ->where('user_id', '=', $userId)
            ->where('revoked', '=', false)
            ->exists();
    }
}
