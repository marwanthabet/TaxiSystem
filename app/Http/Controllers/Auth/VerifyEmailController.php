<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailController extends Controller
{
    //
    public function notice(){
        return view('cms.auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect('/cms/admin');
    }

    public function send(Request $request){
        if(! $request->user()->hasVerifiedEmail()){
            $request->user()->sendEmailVerificationNotification();
            return response()->json(['message' => 'Verification link sent!'], Response::HTTP_OK);
        }else{
            return response()->json(['message' => 'Email has been verified!'], Response::HTTP_BAD_REQUEST);
        } 
    }
}
