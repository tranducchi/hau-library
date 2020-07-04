<?php

namespace App\Http\Controllers\admin;

use App\Books;
use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Books::select('id', 'name', 'slug', 'cover', 'composer')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.book.list', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Categories::select('id', 'name', 'description')->get();
        return view('admin.book.add', compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|min:3',
            'description' => 'required',
            'quantity' => 'required',
        ]);
        $book = new Books;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->quantity = $request->quantity;
        $book->cat_id = $request->cat_id;
        $book->slug = str_slug($request->name);
        $book->composer = $request->composer;
        if($request->hasFile('cover')){
            $img = $request->file('cover');
            $name_image = $img->getClientOriginalName();
            $request->file('cover')->storeAs(
                '/public/covers', $name_image
            );
            $book->cover = $name_image;
        }else{
            $book->cover = 'no-image.png';
        }
        $book->save();
        return redirect()->back()->with('success', 'Thành công !');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Categories::select('id', 'name', 'description')->get();
        $book = Books::select('id', 'name','slug', 'description', 'composer', 'quantity', 'cover', 'cat_id')->where('slug',$id)->get();
        return view('admin.book.edit', compact('book', 'cat'));
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
        //
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'quantity' => 'required',
        ]);
        $book = Books::where('slug', $id)->first();
        $book->name = $request->name;
        $book->slug = str_slug($request->name);
        $book->description = $request->description;
        $book->composer = $request->composer;
        $book->quantity = $request->quantity;
        if($request->hasFile('cover')){
            $img = $request->file('cover');
            $name_img = $img->getClientOriginalName();
            $request->file('cover')->storeAs(
                '/public/covers', $name_img
            );
            $book->cover = $name_img;
        }
        $book->save();
        return redirect()->back()->with('success', 'Thành công ! ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
