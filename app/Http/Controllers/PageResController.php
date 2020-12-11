<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

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
            'sixthPic' => 'required'
        ]);
        $pageCode = 'site/' . $request->input('pageCode') . '/ua';
        Page::createPage($request);
        Image::createImage($request);
        return redirect($pageCode)->with('success', 'Page saved!');
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
        $request->validate([
            'code' => 'required',
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

        $page->update($request->all());
        Image::updateImages($request);

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
