<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
{
    //
    public function showDashboard(Request $request){
        return response()->view('cms.parent');
    }

    public function changeLanguage(Request $request, $language){
        $newLanguage = in_array($language, ['ar','en']) ? $language : 'en';
        if(!App::isLocale($newLanguage)){
            App::setLocale($newLanguage);
            session()->put('lang', $newLanguage);
        }
        return redirect()->back();
    }
}
