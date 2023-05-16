<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Postage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "View Postages"]];
        $postages = Postage::get();
        return view('publications.index', compact('breadcrumbs', 'postages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Add Postages"]];
        $invoices = Bill::get()->pluck('invoice_no');
        return view('postage.create', compact('breadcrumbs', 'invoices'));
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
                'name' => 'required|max:255',
                'city' => 'required|max:255',
                'registration_no' => 'required|max:255',
                'date' => 'required',
                'invoice_no' => 'required',
            ]
        );
        try{
            Postage::create([
                'name' => $request->name,
                'city' => $request->city,
                'registration_no' => $request->registration_no,
                'invoice_no' => $request->invoice_no,
                'date' => $request->date,
                'details' => $request->detail,
                'status' => $request->status
            ]);
            return redirect()->back()
            ->with('success', 'Postage added successfully');
        }
        catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while adding postage');
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
        //
    }
}
