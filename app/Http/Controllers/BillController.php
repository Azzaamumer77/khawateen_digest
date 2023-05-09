<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "View Records"]];
        $bills = Bill::get();
        return view('bills.index', compact('breadcrumbs', 'bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Add Record"]];
        $books = Book::get();
        return view('bills.create', compact('breadcrumbs','books'));
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
            'publication' => 'required',
            'invoice_no' => 'required',
            'debit'=>'sometimes',
            'credit' => 'sometimes',
            'date' => 'required',
        ]);

        try {
            Bill::create([
                'publication_id'=>$request->publication,
                'invoice_no' => $request->invoice_no,
                'debit' => $request->debit,
                'credit' => $request->credit,
                'date' => $request->date
            ]);
            return redirect()->route('publication_invoices.index')
            ->with('success', 'Record added successfully');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while adding record');
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
        Bill::whereId($id)->delete();
        return redirect()->route('publication_invoices.index')
                    ->with('success', 'Record deleted successfully');
    }
}
