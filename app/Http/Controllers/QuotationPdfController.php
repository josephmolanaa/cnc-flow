<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationPdfController extends Controller
{
    public function download(Quotation $quotation)
    {
        $pdf = Pdf::loadView('pdf.quotation', [
            'quotation' => $quotation,
            'items'     => $quotation->items,
            'customer'  => $quotation->customer,
        ]);

        return $pdf->download("Penawaran-{$quotation->nomor}.pdf");
    }
}