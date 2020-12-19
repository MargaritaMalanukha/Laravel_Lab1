<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public static $options = ['creation_date', 'updating_date', 'alphabet'];

    public function page(Request $request) {
        $page = Page::render($request->route('pageCode')); //returns one page

        if ($request->route('pageCode') != 'countries' && $page->aliasAt != null){
            Page::fillAlias($page);
            $image = Image::render($page->aliasAt);
            $lang = $request->route('lang');
            return view('info')
                ->with('page', $page)
                ->with('image', $image)
                ->with('lang', $lang);
        }

        if ($request->route('pageCode') == 'countries') { //define if the page if a main page (it hasn't got any properties)
            $pages = Page::renderChildren($request->route('pageCode'));
            return view('container')
                ->with('pages', $pages)
                ->with('lang', $request->route('lang'))
                ->with('parentCode', 'error')
                ->with('options', self::$options);
        }


        if (Page::hasAChild($page->code) == true) { //define if the page is a catalog
            $pages = Page::renderChildren($request->route('pageCode'));
            return view('container')
                ->with('pages', $pages)
                ->with('lang', $request->route('lang'))
                ->with('parentCode', $page->parentCode)
                ->with('options', self::$options);
        }
        if ($page->contentUA == null) { //if a catalog (page without content) has no children
            return view('pageNotFound');
        }
        $image = Image::render($page->code); //returns array of images
        $lang = $request->route('lang');

        return view('info')
            ->with('page', $page)
            ->with('image', $image)
            ->with('lang', $lang);
    }

    public function order(Request $request) {
        $pageCode = $request->route('pageCode');
        if ($request->input('order') == 'creation_date') {
            Page::saveOrder('creation_date', $pageCode);
            $this->swapWithFirst('creation_date');
            $orderedPages = Page::orderByCreationDate($pageCode);
        } else if ($request->input('order') == 'updating_date') {
            Page::saveOrder('updating_date', $pageCode);
            $this->swapWithFirst('updating_date');
            $orderedPages = Page::orderByUpdatingDate($pageCode);
        } else {
            Page::saveOrder('alphabet', $pageCode);
            $this->swapWithFirst('alphabet');
            $orderedPages = Page::orderByAlphabet($pageCode);
        }
        if ($pageCode == 'countries') $pageCode = 'error';
        return view('container')
            ->with('pages', $orderedPages)
            ->with('lang', 'ua')
            ->with('parentCode', $pageCode)
            ->with('options', self::$options);
    }

    public function swapWithFirst($option_name) {
        $id = array_search($option_name, self::$options);
        $temp = self::$options[$id];
        self::$options[$id] = self::$options[0];
        self::$options[0] = $temp;
    }

    public function createAlias() {
        return view('create')
            ->with('pageType', 'alias');
    }


}
