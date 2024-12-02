<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Categories;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $news = News::all();
        return view('news.tampil', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('news.tambah', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $ImageName = time() . '.' .
            $request->thumbnail->extension();

        $request->thumbnail->move(public_path('uploads'), $ImageName);

        $news = new News;

        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->input('category_id');
        $news->thumbnail = $ImageName;

        $news->save();

        return redirect('/news')->with('success', 'Data Berita Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('news.detail', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::all();
        $news = News::find($id);

        return view('news.edit', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        $news = News::find($id);

        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->input('category_id');
        if ($request->has('thumbnail')) {
            if ($news->thumbnail != null) {
                $path = "uploads/";
                File::delete($path . $news->thumbnail);
            }
            $ImageName = time() . '.' .
                $request->thumbnail->extension();
            $request->thumbnail->move(public_path('uploads'), $ImageName);

            $news->thumbnail = $ImageName;
        }

        $news->save();

        return redirect('/news')->with('success', 'Data Berita Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $path = "uploads/";
        File::delete($path . $news->thumbnail);

        $news->delete();

        return redirect('/news')->with('success', 'Data Berita berhasil Didelete');
    }

    public function detail($id)
    {
        $news = News::find($id);
        return view('detail', ['news' => $news]);
    }
}
