<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function changeLang(Request $request) {
        $lang = $request->input('lang');
        $request->session()->put('lang', $lang);
    }
}
