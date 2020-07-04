<?php

namespace App\Http\Controllers\admin;

use App\Categories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Categories::select('id', 'slug', 'name', 'description')->paginate(10);
        return view('admin.category.list', compact('cat'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.add');
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
            'name' => 'required|unique:categories|min:5',
            'describe' => 'required',
        ]);
        $cat = new Categories();
        $cat->name = $request->name;
        $cat->slug = str_slug($request->name);
        $cat->description = $request->describe;
        $cat->save();
        return back()->with('success', 'Thành công ! ');
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
        $cat = Categories::select('name', 'slug', 'description')->where('slug', $id)->get();
        return view('admin.category.edit', compact('cat'));
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
            'name' => 'required|min:5',
            'describe' => 'required',
        ]);
        $cat = Categories::where('slug', $id)->first();
        $cat->name = $request->name;
        $cat->description = $request->describe;
        $cat->save();
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
        $c = Categories::find($id);
        $c->delete();
        return redirect()->back();
    }
}
