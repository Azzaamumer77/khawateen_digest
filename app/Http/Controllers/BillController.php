<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $total_amount = 0;
        foreach($request->books as $book)
        {
            $book_id = Book::find($book['name']);
            $left_quantity = $book_id->quantity - $book['quantity'];
            $total_amount = $total_amount + (($book_id->price) * $book['quantity']) ;
            $book_id->update(['quantity'=>$left_quantity]);
        }
        $request->validate([
            'name' => 'required',
            'invoice_no' => 'required|unique:bills',
        ]);

        try {
            $bill=Bill::create([
                'customer_name'=>$request->name,
                'invoice_no' => $request->invoice_no,
                'total_amount' => $request->total_bill,
                'discount' => $request->total_discount
            ]);
            $books = $request->input('books'); // Assuming books input is an array of book IDs

        foreach ($books as $bookId) {
            $book = Book::find($bookId['name']);        
            if ($book) {
                $bill->books()->attach($bookId['name'], [
                    'quantity' => $bookId['quantity'],
                    'discount' => $bookId['discount']
                ]);
            }
        };
        $pdf = PDF::loadView('bills.invoice', compact('bill'));
         return $pdf->download('invoice.pdf');
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
        $bill = Bill::find($id);
        return view('bills.view', compact('bill'));
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
