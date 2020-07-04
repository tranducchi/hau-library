<?php

namespace App\Http\Controllers\admin;

use App\Books;
use App\GetBooks;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $gb = GetBooks::all()->count();
        $b  = Books::all()->count();
        $u = User::all()->count();
        $x = Books::sum('quantity');
        $less =number_format(100-($gb/$x)*100);
        return view('admin.home', compact('gb', 'b', 'less', 'x', 'u'));
    }
}
