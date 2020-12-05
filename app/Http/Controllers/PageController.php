<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function page(Request $request) {

        $page = Page::render($request); //returns one page
        $image = Image::render($request); //returns array of images
        $lang = $request->route('lang');

        return view('info')
            ->with('page', $page)
            ->with('image', $image)
            ->with('lang', $lang);
    }
}
