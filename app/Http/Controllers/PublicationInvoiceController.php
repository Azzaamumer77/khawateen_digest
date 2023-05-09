<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicationInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "View Records"]];
        $publication_record = PublicationInvoice::get();
        return view('publication_invoices.index', compact('breadcrumbs', 'publication_record'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Add Record"]];
        $publications = Publication::get();
        return view('publication_invoices.create', compact('breadcrumbs','publications'));
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
            PublicationInvoice::create([
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
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Update Records"]];
        $record = PublicationInvoice::whereId($id)->first();
        return view('publication_invoices.create', compact('breadcrumbs', 'record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Update Records"]];
        $publications = Publication::get();
        $record = PublicationInvoice::whereId($id)->first();
        return view('publication_invoices.create', compact('breadcrumbs', 'record','publications'));  
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
            'publication' => 'required',
            'invoice_no' => 'required',
            'debit'=>'sometimes',
            'credit' => 'sometimes',
            'date' => 'required',
        ]);

        try {
            $record = PublicationInvoice::whereId($id)->first();
            $record->update([
                'publication_id'=>$request->publication,
                'invoice_no' => $request->invoice_no,
                'debit' => $request->debit,
                'credit' => $request->credit,
                'date' => $request->date
            ]);

            return redirect()->route('publication_invoices.index')
            ->with('success', 'Record updated successfully');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while updating record');
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
        PublicationInvoice::whereId($id)->delete();
        return redirect()->route('publication_invoices.index')
                    ->with('success', 'Record deleted successfully');
    }
}
