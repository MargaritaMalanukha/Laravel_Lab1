<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomField extends Model
{
    use HasFactory;

    protected $fillable = ['fieldName', 'value', 'pageCode'];

    public static function create(Request $request)
    {
        $fields = Field::findAllByEntity($request->session()->get('selectedEntity'));
        for ($i = 0; $i < count($fields); $i++) {
            DB::table('customfields')->insert([
                'fieldName' => $fields[$i]->caption,
                'value' => $request->input($fields[$i]->field),
                'pageCode' => $request->input('pageCode')
            ]);
        }
    }

    public static function findAllByPageCode($pageCode) {
        return DB::table('customfields')->where('pageCode', '=', $pageCode)->get();
    }

    public static function deleteF($pageCode)
    {
        DB::table('customfields')->where('pageCode', '=', $pageCode)->delete();
    }

    public static function updateF(Request $request, $page){
        $fields = CustomField::findAllByPageCode($page->code);
        for ($i = 0; $i < count($fields); $i++) {
            $fields[$i]->fieldName = $request->input('caption-' . $i);
            $fields[$i]->value = $request->input('value-' . $i);
            echo $fields[$i]->value;
        }
        for ($i = 0; $i < count($fields); $i++) {
            $field = $fields[$i];
            DB::table('customfields')->where('id', '=', $field->id)->update([
                'fieldName' => $field->fieldName,
                'value' => $field->value
            ]);
        }
        return count($fields);
    }
}
