<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function print($id)
    {
        $publications = Publication::where('id', $id)->get();
        $totalDebit = $publications->publication_invoices->sum('debit');
        $totalCredit = $publications->publication_invoices->sum('credit');
        $pdf = PDF::loadView('invoice', compact('publications', 'totalDebit', 'totalCredit'));
        return $pdf->download('invoice.pdf');
    }
}