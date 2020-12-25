<?php

namespace App\Http\Controllers;

use App\Models\CustomField;
use App\Models\Entitie;
use App\Models\Field;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Page;

class PageResController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin')
            ->with('pages', $pages);
    }

    public function create(Request $request)
    {
        $fields = Field::findAllByEntity($request->session()->get('selectedEntity'));
        return view('create')
            ->with('pageType', 'page')
            ->with('fields', $fields);
    }

    public function store(Request $request)
    {
        if ($request ->input('aliasAt') != null) {
            $request->validate([
                'pageCode' => 'required',
                'parentCode' => 'required',
                'aliasAt' => 'required'
            ]);
            Page::createAlias($request);
            return redirect()->route('page.index')->with('success', 'Alias saved!');
        } else if ($request -> input('container') == 'page') {
            $request->validate([
                'pageCode' => 'required',
                'captionUA' => 'required',
                'captionRU' => 'required',
                'imageMain' => 'required'
            ]);

            $pageCode = 'site/' . $request->input('pageCode') . '/ua';
            Page::createPage($request);
            CustomField::create($request);
            $request->session()->flush();
            return redirect($pageCode)->with('success', 'Page saved!');
        } else if ($request -> input('container') == 'container item') {
            $request->validate([
                'pageCode' => 'required',
                'captionUA' => 'required',
                'captionRU' => 'required',
                'imageMain' => 'required',
                'container' => 'required'
            ]);
            if ($request->input('parentCode') == null) {
                $request->merge([
                    'parentCode' => 'countries'
                ]);
            }
            Page::createPage($request);
            return redirect()->route('page.index')
                ->with('success', 'Project created successfully');
        }
    }

    public function edit(Page $page)
    {
        if ($page->aliasAt != null) $images = Image::render($page->aliasAt);
        else $images = Image::render($page->code);
        $fields = CustomField::findAllByPageCode($page->code);
        return view('edit')
            ->with('page', $page)
            ->with('images', $images)
            ->with('fields', $fields);
    }

    public function update(Request $request, $pageCode)
    {
        $page = Page::render($pageCode);
        $request->validate([
            'captionUA' => 'required',
            'captionRU' => 'required'
        ]);
        CustomField::updateF($request, $page);
        Page::updateP($request, $pageCode);

        return redirect()->route('page.index')
            ->with('success', 'Page was updated successfully!');
    }

    public function destroy(Page $page)
    {
        $pageCode = $page->code;
        Image::deleteImages($pageCode);
        Page::deletePage($pageCode);
        CustomField::deleteF($pageCode);
        return redirect()->route('page.index')
            ->with('success', 'Page was deleted successfully!');
    }




}
