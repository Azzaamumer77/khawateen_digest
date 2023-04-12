<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'urdu_name' => 'required|max:255',
                'english_name' => 'required|max:255',
                'author' => 'required|max:255',
                'publications_name' => 'required|max:255',
                'price' => 'required',
                // 'discounted_price' => 'required',
                'quantity' => 'required',
                'file' => 'image|mimes:jpeg,png,jpg|required|max:20480',
            ]
        );
        // try{

            if ($request->hasfile('file')) {
                $image_name  = time() . '.' . Str::random(7) . '.' . $request->file('file')->getClientOriginalExtension();
            }

            $book = Book::create([
                'urdu_name' => $request->input('urdu_name'),
                'english_name' => $request->input('english_name'),
                'author' => $request->input('author'),
                'publications_name' => $request->input('publications_name'),
                'price' => $request->input('price'),
                'discounted_price' => $request->input('discounted_price'),
                'quantity' => $request->input('quantity'),
                'image' => $image_name,
            ]);

            if ($book->save()) {
                Storage::putFileAs('public/books/', $request->file('file'), $image_name);
                return redirect()->route('books.create')
                    ->with('success', 'Book added successfully');
            } else {
                return redirect()->back()
                    ->with('error', 'Error while adding book');
            }
        // }
        // catch(\Exception $e)
        // {
        //     Log::error($e->getMessage());
        //     return redirect()->back()
        //             ->with('error', 'Error while creating book');
        // }
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
        //
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
