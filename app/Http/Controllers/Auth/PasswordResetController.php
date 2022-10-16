<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    //
    public function requestPassword()
    {
        return view('cms.auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $validator = Validator($request->all(), [
            'email' => 'required|email'
        ]);
        if (!$validator->fails()) {
            $status = Password::sendResetLink(
                $request->only('email')
            );
            return $status === Password::RESET_LINK_SENT
                ? response()->json(['message' =>  __($status)])
                : response()->json(['message' =>  __($status)], Response::HTTP_BAD_REQUEST);

            // return $status === Password::RESET_LINK_SENT
            //     ? back()->with(['status' => __($status)])
            //     : back()->withErrors(['email' => __($status)]);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(Request $request, $token)
    {
        $passwordReset = DB::table('password_resets')->where('token', '=', Hash::make($token))->first();
        return view('cms.auth.reset-password', ['token' => $token, 'email' => $request->input('email')]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        if (!$validator->fails()) {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );
            return $status === Password::PASSWORD_RESET
                ? response()->json(['message' => __($status)], Response::HTTP_OK)
                : response()->json(['message' => __($status)], Response::HTTP_BAD_REQUEST);

            // return $status === Password::PASSWORD_RESET
            //     ? redirect()->route('login')->with('status', __($status))
            //     : back()->withErrors(['email' => [__($status)]]);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
