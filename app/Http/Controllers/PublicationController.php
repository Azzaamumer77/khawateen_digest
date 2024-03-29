<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PublicationController extends Controller
{
    public function index()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "View Publications"]];
        $publication_record = Publication::get();
        return view('publications.index', compact('breadcrumbs', 'publication_record'));
    }

    public function create()
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Add Publication"]];
        return view('publications.create', compact('breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            Publication::create([
                'name' => $request->name,
            ]);
            return redirect()->route('publications.index')
            ->with('success', 'Record added successfully');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while adding record');
        }

    }

    public function edit($id)
    {
        $breadcrumbs = [['link' => "/", 'name' => "Dashboard"], ['name' => "Update Publication"]];
        $record = Publication::whereId($id)->first();
        return view('publications.create', compact('breadcrumbs', 'record'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $record = Publication::whereId($id)->first();
            $record->update([
                'name' => $request->name,
            ]);

            return redirect()->route('publications.index')
            ->with('success', 'Record updated successfully');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()
                    ->with('error', 'Error while updating record');
        }

    }

    public function destroy($id)
    {
        Publication::whereId($id)->delete();
        return redirect()->route('publications.index')
                    ->with('success', 'Record deleted successfully');
    }


}
