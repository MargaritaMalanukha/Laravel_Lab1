<?php

namespace App\Http\Controllers;

use App\Models\Entitie;
use Illuminate\Http\Request;

class EntitieController extends Controller
{

    public function index() {
        $entities = Entitie::all();
        return view('custom_fields.choose_entity')
            ->with('entities', $entities);
    }

    public function create()
    {
        return view('custom_fields.create_entity');
    }

    public function store(Request $request)
    {
        $request->validate([
            'entity' => 'required'
        ]);
        Entitie::create($request);
        return redirect()
            ->route('custom_fields.index')
            ->with('success', 'Entity added!');
    }

    public function destroy($entity)
    {
        Entitie::deleteE($entity);
        return redirect()
            ->route('custom_fields.index')
            ->with('success', 'Entity deleted!');
    }
}
