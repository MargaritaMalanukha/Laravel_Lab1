<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'captionUA', 'captionRU', 'contentUA',
        'contentRU', 'imageMain', 'parentCode', 'aliasAt', 'order_type', 'container',
        'created_at', 'updated_at'];

    public static function createAlias(Request $request) {
        DB::table('pages')->insert([
            'code' => $request->input('pageCode'),
            'parentCode' => $request->input('parentCode'),
            'aliasAt' => $request->input('aliasAt')
        ]);
    }

    public static function fillAlias($page) {
        if ($page->contentUA == null) {
            $pageRefersTo = self::render($page->aliasAt);
            DB::table('pages')->where('code', '=', $page->code)->update([
                'captionUA' => $pageRefersTo->captionUA,
                'captionRU' => $pageRefersTo->captionRU,
                'contentUA' => $pageRefersTo->contentUA,
                'contentRU' => $pageRefersTo->contentRU,
                'container' => $pageRefersTo->container,
                'imageMain' => $pageRefersTo->imageMain
            ]);
        }
    }

    public static function fillAliasTile($page) {
        $pageRefersTo = self::render($page->aliasAt);
        DB::table('pages')->where('code', '=', $page->code)->update([
            'captionUA' => $pageRefersTo->captionUA,
            'captionRU' => $pageRefersTo->captionRU,
            'container' => $pageRefersTo->container,
            'imageMain' => $pageRefersTo->imageMain
        ]);
    }

    public static function render($pageCode) {
        return DB::table('pages')
            ->where('code', '=', $pageCode)->first();
    }

    public static function renderChildren($pageCode) {
        $page = self::render($pageCode);
        if ($pageCode != 'countries' && $page->aliasAt != null && $page->captionUA == null) {
            self::fillAliasTile($page);
        }
        return DB::table('pages')
            ->where('parentCode', '=', $pageCode)->get();
    }

    public static function hasAChild($pageCode) {
        $pages = self::renderChildren($pageCode);
        if (count($pages) == 0) return false;
        return true;
    }

    public static function createPage(Request $request)
    {
        Parser::process($request);
        if ($request->input('container') == 'page') {
            DB::table('pages')->insert([
                'code' => $request->input('pageCode'),
                'captionUA' => $request->input('captionUA'),
                'captionRU' => $request->input('captionRU'),
                'contentUA' => Parser::$contentUA,
                'contentRU' => Parser::$contentRU,
                'container' => $request->input('container'),
                'parentCode' => Parser::$parentCode,
                'imageMain' => $request->input('imageMain'),
                'entity' => $request->session()->get('selectedEntity')
            ]);
        } else {
            DB::table('pages')->insert([
                'code' => $request->input('pageCode'),
                'captionUA' => $request->input('captionUA'),
                'captionRU' => $request->input('captionRU'),
                'imageMain' => $request->input('imageMain'),
                'container' => $request->input('container'),
            ]);
        }

    }

    public static function deletePage($pageCode) {
        DB::table('pages')->where('code', $pageCode)->delete();
    }

    public static function orderByCreationDate($parentCode) {
        return DB::table('pages')->where('parentCode', '=', $parentCode)->orderByDesc('created_at')->get();
    }

    public static function orderByUpdatingDate($parentCode) {
        return DB::table('pages')->where('parentCode', '=', $parentCode)->orderByDesc('updated_at')->get();
    }

    public static function orderByAlphabet($parentCode) {
        return DB::table('pages')->where('parentCode', '=', $parentCode)->orderBy('captionUA')->get();
    }

    public static function saveOrder($orderType, $parentCode) {
        DB::table('pages')->where('parentCode', '=', $parentCode)->update([
            'order_type' => $orderType
        ]);
    }

    public static function updateP(Request $request, $pageCode)
    {
        DB::table('pages')->where('code', '=', $pageCode)->update([
            'captionUA' => $request->input('captionUA'),
            'captionRU' => $request->input('captionRU'),
            'contentUA' => $request->input('contentUA'),
            'contentRU' => $request->input('contentRU'),
            'container' => $request->input('container'),
            'parentCode' => $request->input('parentCode'),
            'imageMain' => $request->input('imageMain')
        ]);
    }
}
