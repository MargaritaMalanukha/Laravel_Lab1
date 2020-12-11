<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'captionUA', 'captionRU', 'contentUA', 'contentRU'];

    public static function render(Request $request) {
        return DB::table('pages')
            ->where('code', '=', $request->route('pageCode'))->first();
    }

    public static function createPage(Request $request)
    {
        DB::table('pages')->insert([
            'code' => $request->input('pageCode'),
            'captionUA' => $request->input('captionUA'),
            'captionRU' => $request->input('captionRU'),
            'contentUA' => $request->input('contentUA'),
            'contentRU' => $request->input('contentRU')
        ]);
    }

    public static function deletePage($pageCode) {
        DB::table('pages')->where('code', $pageCode)->delete();
    }
}
