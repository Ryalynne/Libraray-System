<?php

namespace App\Http\Controllers;

use App\Models\booklist;
use App\Models\copies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BooklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
    }
    public function create()
    {
       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isbn' => 'required|numeric|min:1',
            'author' => 'required',
            'publisher' => 'required',
            'datepublish' => 'required|date',
            'booktitle' => 'required',
            'genre' => 'required',
            'copies' => 'required|numeric|min:1'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
                     
        $book = booklist::create([
            'booktitle' => $request->booktitle,
            'author' => $request->author,
            'datepublish' => $request->datepublish,
            'publisher' => $request->publisher,
            'isbn' => $request->isbn,
            'genre' => $request->genre,
        ]);
        copies::create([
            'bookid'=> $book->id,
            'action'=> "added",
            'copies'=> $request->copies
        ]);     
        return response()->json([
            'status'=>200,
            'message'=>'Book Added Successfully.'  
        ]);       
    }
    public function show(booklist $booklist)
    {
        //
    }

    public function edit(booklist $booklist)
    {
       
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booklist $booklist)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(booklist $booklist)
    {
        //
    }

    public function updatebooks(Request $request){
        $book = booklist::find($request->bookid);
        $book->update(['booktitle'=> $request->updatebooktitle,'author'=> $request->updateauthor,'datepublish'=> $request->updatepublish,
        'publisher'=> $request->updatepublisher,'genre'=> $request->updategenre]);
        return back();     
     }

    public function get_book($data)
    {
        $book  = booklist::find($data);
        return compact('book');
    }


}