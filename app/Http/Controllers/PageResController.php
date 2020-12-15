<?php

namespace App\Http\Controllers;

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

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        if ($request -> input('container') == 'page') {
            $request->validate([
                'pageCode' => 'required',
                'captionUA' => 'required',
                'captionRU' => 'required',
                'contentUA' => 'required',
                'contentRU' => 'required',
                'firstPic' => 'required',
                'secondPic'=> 'required',
                'thirdPic' => 'required',
                'fourthPic' => 'required',
                'fifthPic' => 'required',
                'sixthPic' => 'required',
                'imageMain' => 'required',
                'parentCode' => 'required'
            ]);
            $pageCode = 'site/' . $request->input('pageCode') . '/ua';
            Image::createImage($request);
            Page::createPage($request);
            return redirect($pageCode)->with('success', 'Page saved!');
        } else {
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
        $images = Image::render($page->code);
        return view('edit')
            ->with('page', $page)
            ->with('images', $images);
    }

    public function update(Request $request, Page $page)
    {
        if ($request->input('container') == 'page') {
            $request->validate([
                'captionUA' => 'required',
                'captionRU' => 'required',
                'contentUA' => 'required',
                'contentRU' => 'required',
                '1Pic' => 'required',
                '2Pic'=> 'required',
                '3Pic' => 'required',
                '4Pic' => 'required',
                '5Pic' => 'required',
                '6Pic' => 'required'
            ]);
            Image::updateImages($request);
        } else {
            $request->validate([
                'captionUA' => 'required',
                'captionRU' => 'required',
                'imageMain' => 'required'
            ]);
        }
        $page->update($request->all());

        return redirect()->route('page.index')
            ->with('success', 'Project updated successfully');
    }

    public function destroy(Page $page)
    {
        $pageCode = $page->code;
        Image::deleteImages($pageCode);
        Page::deletePage($pageCode);
        return redirect()->route('page.index')
            ->with('success', 'Page was deleted successfully!');
    }




}
