<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::select('id','title', 'description', 'image')->orderBy('created_at', 'desc')->get();
        return view('admin.slide.list', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.add');
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
            'title' => 'required',
        ]);
        // save data
        $slide = new Slide();
        $slide->title = $request->title;
        $slide->description = $request->description;
        if($request->hasFile('image')){
            $img = $request->file('image');
            $img_name = $img->getClientOriginalName();
            $img->storeAs(
                '/public/covers', $img_name
            );
            $slide->image = $img_name;
        }else{
            $slide->image = 'no-image.png';
        }
        $slide->save();
        return redirect()->back()->with('success', 'Thành công ! ');
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
        $slide = Slide::select('id', 'title', 'description', 'image')->where('id', $id)->get();
        return view('admin.slide.edit', compact('slide'));
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
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $slide = Slide::find($id);
        $slide->title = $request->title;
        $slide->description = $request->description;
        if($request->hasFile('image')){
            $img = $request->file('image');
            $img_name = $img->getClientOriginalName();
            $img->storeAs(
                '/public/covers', $img_name
            );
            $slide->image = $img_name;
        }
        $slide->save();
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
        $slide = Slide::find($id);
        $slide->delete();
        return redirect()->back()->with('success', 'Thành công ! ');
    }
}
