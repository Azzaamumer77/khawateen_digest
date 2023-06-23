<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "View Records"]];
        $authors = Author::get();
        return view('authors.index',compact('authors','breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $popular_authors = Author::where('is_popular',1)->count();
        return view('authors.create', compact('popular_authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
         'name'=>'required|max:250',
         'file' => 'image|mimes:jpeg,png,jpg|max:20480',
        ]);
        try{
            $author = Author::create([
                'name'=>$request->name,
                'is_popular' => isset($request->popular) ? 1 : 0,
            ]);
            if($request->hasFile('file'))
            {
                $image_name  = time() . '.' . Str::random(7) . '.' . $request->file('file')->getClientOriginalExtension();
                $author->image = $image_name;
                Storage::putFileAs('public/authors/', $request->file('file'), $image_name);
            }
            if($author->save())
            {
                return redirect()->route('authors.index')
                    ->with('success', 'Author added successfully');
            } 
            else {
                return redirect()->back()
                    ->with('error', 'Error while adding Author');
            }
        } 
        catch(\Exception $e) 
        {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while adding author');
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
        $author = Author::find($id);
        $popular_authors = Author::where('is_popular',1)->count();
        return view('authors.create',compact('author','popular_authors'));
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
      $author = Author::find($id);
      $request->validate([
          'name'=>'required|max:250',
          'file' => 'image|mimes:jpeg,png,jpg|max:20480',
      ]);
    //   try{
          $author->update([
              'name'=>$request->name,
              'services'=>$request->services,
              'is_popular' => isset($request->popular) ? 1 : 0,
          ]);
          if($request->hasFile('file'))
          {
              $image_name  = time() . '.' . Str::random(7) . '.' . $request->file('file')->getClientOriginalExtension();
              $author->image = $image_name;
              Storage::putFileAs('public/authors/', $request->file('file'), $image_name);
          }
          if($author->save())
          {
              return redirect()->route('authors.index')
                  ->with('success', 'Author Updated successfully');
          } 
          else {
              return redirect()->back()
                  ->with('error', 'Error while Updating Author');
          }
    //    } 
    //    catch(\Exception $e) 
    //    {
    //        Log::error($e->getMessage());
    //        return redirect()->back()
    //                ->with('error', 'Error while Updating Author');
    //    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();
        return redirect()->route('authors.index')
        ->with('success', 'Author deleted successfully');
    }
}
