<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function print($name)
    {
        $publications = Publication::where('name', $name)->get();
        $totalDebit = $publications->sum('debit');
        $totalCredit = $publications->sum('credit');
        $pdf = PDF::loadView('invoice', compact('publications', 'totalDebit', 'totalCredit'));
        return $pdf->download('invoice.pdf');
    }
}