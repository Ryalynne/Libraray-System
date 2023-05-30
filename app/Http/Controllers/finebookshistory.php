<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\borrowpage;
use App\Models\studentlist;
use Illuminate\Http\Request;

class finebookshistory extends Controller
{
    /**
     * Show the form for creating the resource.
     */

     public function index()
    {
        $books = booklist::where('ishide', false)->paginate(10);
        $return = borrowpage::where('ishide', false)->where('bookstatus', 'fine')->paginate(10);
        $student = studentlist::where('ishide', false)->paginate(10);
        return view('finedhistory', compact('books','return','student'));
    }

}
