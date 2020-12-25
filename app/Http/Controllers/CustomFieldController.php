<?php

namespace App\Http\Controllers;

use App\Models\Entitie;
use App\Models\Field;
use Illuminate\Http\Request;

class CustomFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entitie::all();
        $fields = Field::getAllSorted();
        return view('custom_fields.custom_fields')
            ->with('fields', $fields)
            ->with('entities', $entities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('custom_fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'field' => 'required',
            'caption' => 'required',
            'entity' => 'required'
        ]);
        Field::create($request);
        return redirect()
            ->route('custom_fields.index')
            ->with('success', 'Field added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param $fieldCode
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($fieldCode)
    {
        $field = Field::findByField($fieldCode);
        return view('custom_fields.edit')
            ->with('field', $field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $fieldCode)
    {
        $request->validate([
            'field' => 'required',
            'caption' => 'required',
            'entity' => 'required'
        ]);
        Field::updateF($request, $fieldCode);

        return redirect()
            ->route('custom_fields.index')
            ->with('success', 'Field updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($fieldCode)
    {
        Field::deleteF($fieldCode);
        return redirect()
            ->route('custom_fields.index')
            ->with('success', 'Field deleted!');
    }
}
