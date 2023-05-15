<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Publication;
use App\Models\PublicationInvoice;
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
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "View Books"]];
        $books = Book::get();
        return view('books.list', compact('books', 'breadcrumbs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publications = Publication::get();
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Add Books"]];
        return view('books.create',compact('breadcrumbs','publications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'urdu_name' => 'required|max:255',
                'english_name' => 'required|max:255',
                'author' => 'required|max:255',
                'publication' => 'required|max:255',
                'price' => 'required',
                'quantity' => 'required',
                'file' => 'image|mimes:jpeg,png,jpg|required|max:20480',
            ]
        );
        try {
            if ($request->hasfile('file')) {
                $image_name  = time() . '.' . Str::random(7) . '.' . $request->file('file')->getClientOriginalExtension();
            }
            $book = Book::create([
                'urdu_name' => $request->urdu_name,
                'english_name' => $request->english_name,
                'author' => $request->author,
                'publication_id' => $request->publication,
                'price' => $request->price,
                'discounted_price' => $request->discounted_price,
                'quantity' => $request->quantity,
                'image' => $image_name,
            ]);

            if ($book->save()) {
                Storage::putFileAs('public/books/', $request->file('file'), $image_name);
                return redirect()->route('books.index')
                    ->with('success', 'Book added successfully');
            } else {
                return redirect()->back()
                    ->with('error', 'Error while adding book');
            }
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while creating book');
        }
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
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['link' => "/books", 'name' => "All Books"], ['name' => "Edit Books"]];
        $book = Book::whereId($id)->first();
        $publications = Publication::get();
        return view('books.create', compact('book','publications','breadcrumbs'));
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
            'urdu_name' => 'required|max:255',
            'english_name' => 'required|max:255',
            'author' => 'required|max:255',
            'publication' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg|max:20480',
        ]);
        try {
            $book = Book::whereId($id)->first();
            $book->update([
                'urdu_name' => $request->urdu_name,
                'english_name' => $request->english_name,
                'author' => $request->author,
                'publication_id' => $request->publication,
                'price' => $request->price,
                'discounted_price' => $request->discounted_price,
                'quantity' => $request->quantity,
            ]);
            if ($request->hasfile('file')) {
                $image_name  = time() . '.' . Str::random(7) . '.' . $request->file('file')->getClientOriginalExtension();
                $book = Book::whereId($id)->first();
                $book->update([
                'image' => $image_name,
            ]);
            }

            if ($book->save()) {
                if ($request->hasfile('file'))
                {
                    Storage::putFileAs('public/books/', $request->file('file'), $image_name);
                }
                return redirect()->route('books.index')
                    ->with('success', 'Book Updated successfully');
            } 
            else {
                return redirect()->back()
                ->with('error', 'Error while adding book');
             }
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while updating book');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::whereId($id)->delete();
        return redirect()->route('books.index')
                    ->with('success', 'Book deleted successfully');
    }

    public function records()
    {
        $publications = Publication::get();
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Total Bills"]];
        return view('publications.total_record' ,compact('publications' , 'breadcrumbs'));
    }
    
}
