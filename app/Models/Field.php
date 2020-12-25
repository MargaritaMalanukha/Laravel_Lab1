<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'field', 'caption', 'entity'];

    public static function create(Request $request)
    {
        if (!Entitie::exists($request->input('entity'))){
            $request->merge([
                'entity' => 'none'
            ]);
        }
        DB::table('fields')->insert([
            'field' => $request->input('field'),
            'caption' => $request->input('caption'),
            'entity' => $request->input('entity')
        ]);
    }

    public static function findByField($fieldCode) {
        return DB::table('fields')->where('field', '=', $fieldCode)->first();
    }

    public static function findAllByEntity($entityCode) {
        return DB::table('fields')->where('entity', '=', $entityCode)->orderBy('id')->get();
    }

    public static function updateF(Request $request, $fieldCode)
    {
        if (!Entitie::exists($request->input('entity'))){
            $request->merge([
                'entity' => 'none'
            ]);
        }
        DB::table('fields')->where('field', '=', $fieldCode)->update([
            'field' => $request->input('field'),
            'caption' => $request->input('caption'),
            'entity' => $request->input('entity')
        ]);
    }

    public static function deleteF($fieldCode) {
        DB::table('fields')->where('field', '=', $fieldCode)->delete();
    }

    public static function getAllSorted()
    {
        return DB::table('fields')->orderBy('id')->get();
    }
}
