<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Entitie extends Model
{
    use HasFactory;

    protected $fillable = ['entity'];

    public static function create(Request $request)
    {
        DB::table('entities')->insert([
            'entity' => $request->input('entity'),
        ]);
    }

    public static function deleteE($entity) {
        DB::table('entities')->where('entity', '=', $entity)->delete();
    }

    public static function exists($entityCode)
    {
        $entity = DB::table('entities')->where('entity', '=', $entityCode)->first();
        return $entity != null;
    }
}
