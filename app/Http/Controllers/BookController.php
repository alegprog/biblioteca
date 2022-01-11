<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        
        return response()->json([
            "status"=>true,
            "data"=> $books,
            "message"=> "Success list book"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->description = $request->description;
        $book->released_at = \Carbon\Carbon::parse($request->released_at)->format("Y-m-d");
        $book->category = $request->category;
        $book->rent = 0;
        $book->save();

        return response()->json([
            "status"=>true,
            "data"=> $book,
            "message"=> "Success create book"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        
        return response()->json([
            "status"=>true,
            "data"=> $book,
            "message"=> "Success show book"
        ]);
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
        $book = Book::find($id);
        $book->name = $request->name;
        $book->description = $request->description;
        $book->released_at = \Carbon\Carbon::parse($request->released_at)->format("Y-m-d");
        $book->category = $request->category;
        $book->save();
        
        return response()->json([
            "status"=>true,
            "data"=> $book,
            "message"=> "Success update book"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id)->delete();

        return response()->json([
            "status"=>true,
            "message"=> "Success delete book"
        ]);
    }

    public function rent($id){
        $book = Book::find($id);
        $book->rent = 1;
        $book->save();

        return response()->json([
            "status"=>true,
            "message"=> "Success rent book"
        ]);
    }

    public function unrent($id){
        $book = Book::find($id);
        $book->rent = 0;
        $book->save();

        return response()->json([
            "status"=>true,
            "message"=> "Success unrent book"
        ]);
    }


    public function search(Request $request){

        $books = Book::where('category', $request->category)
        ->orderBy('released_at',$request->released_at)
        ->orderBy('name', 'asc')
        ->get();

        return response()->json([
            "status"=>true,
            "data"=> $books,
            "message"=> "Success unrent book"
        ]);
    } 
}
