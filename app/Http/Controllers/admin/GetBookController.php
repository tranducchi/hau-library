<?php

namespace App\Http\Controllers\admin;

use App\Books;
use App\GetBooks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gb = GetBooks::select('id','book_id', 'student_id', 'status', 'updated_at')->get();
        return view('admin.order-book.request', compact('gb'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $gb = GetBooks::find($id);
        $b = $gb->aboutBook->id;
        $bs = Books::find($b);
        $gb->status = 2;
        $bs->quantity -=1;
        $bs->save();
        $gb->save();
        return redirect()->back()->with('success', 'Thành công !');
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
    public function declineBook($id){
        $gb = GetBooks::find($id);
        $gb->status = 0;
        $gb->save();
        return redirect()->back()->with('success', 'Đã loại bỏ !');
    }
    public function listRefund(){
        $books = GetBooks::select('id', 'student_id', 'book_id', 'status')->where('status', 3)->get();

        return view('admin.order-book.refund', compact('books'));
    }
    public function agredeBook($id){

    }
    public function agreeBook($id){

        $b = GetBooks::find($id);
        $num = $b->aboutBook->id;
        $bs = Books::find($num);
        $b->status =4;
        $bs->quantity +=1;
        $b->save();
        $bs->save();
        return redirect()->back();
    }
}
