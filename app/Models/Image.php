<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Image extends Model
{
    use HasFactory;

    public static function render(Request $request) {
        return DB::table('images')
            ->where('pageCode', '=', $request->route('pageCode'))->get();
    }
}
