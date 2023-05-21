<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function print($id)
    {
        $publication = Publication::find($id);
        $pdf = PDF::loadView('invoice', compact('publication'));
        return $pdf->download('invoice.pdf');
    }
}