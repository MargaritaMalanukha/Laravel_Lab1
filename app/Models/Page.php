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
        'contentRU', 'imageMain', 'parentCode', 'order_type', 'container',
        'created_at', 'updated_at'];

    public static function render($pageCode) {
        return DB::table('pages')
            ->where('code', '=', $pageCode)->first();
    }

    public static function renderChildren($pageCode) {
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
        if ($request->input('container') == 'page') {
            DB::table('pages')->insert([
                'code' => $request->input('pageCode'),
                'captionUA' => $request->input('captionUA'),
                'captionRU' => $request->input('captionRU'),
                'contentUA' => $request->input('contentUA'),
                'contentRU' => $request->input('contentRU'),
                'container' => $request->input('container'),
                'parentCode' => $request->input('parentCode'),
                'imageMain' => $request->input('imageMain')
            ]);
        } else {
            DB::table('pages')->insert([
                'code' => $request->input('pageCode'),
                'captionUA' => $request->input('captionUA'),
                'captionRU' => $request->input('captionRU'),
                'imageMain' => $request->input('imageMain'),
                'container' => $request->input('container'),
                'parentCode' => $request->input('parentCode')
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
}
