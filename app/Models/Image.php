<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [ 'id', 'imageCode', 'pageCode'];

    public static function render($code) {
        return DB::table('images')
            ->where('pageCode', '=', $code)->get();
    }

    public static function createImage(Request $request, $imageURL) {
        DB::table('images')->insert([
            'pageCode' => $request->input('pageCode'),
            'imageCode' => $imageURL
        ]);
    }

    public static function deleteImages($pageCode)
    {
        DB::table('images')->where('pageCode', $pageCode)->delete();
    }

    public static function updateImages(Request $request) {
        self::updateImage('1Pic', $request, 0);
        self::updateImage('2Pic', $request, 1);
        self::updateImage('3Pic', $request, 2);
        self::updateImage('4Pic', $request, 3);
        self::updateImage('5Pic', $request, 4);
        self::updateImage('6Pic', $request, 5);
    }

    public static function updateImage($key, Request $request, $number) {
        $currentPageImages = DB::table('images')->where('pageCode', $request->input('code'))->get();
        $id = $currentPageImages[$number]->id;
        DB::table('images')->where('id', $id)->update([
            'pageCode' => $request->input('code'),
            'imageCode' => $request->input($key)]);
    }
}
