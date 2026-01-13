<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductPdfController extends Controller
{
    public function show(Product $product)
    {
        $this->authorize('viewPdf', $product);

        $product->load('brands');

        $totalPrice = $product->brands->sum('price');

        $pdf = Pdf::loadView('pdf.product', [
            'product'     => $product,
            'totalPrice'  => $totalPrice,
            'generatedAt' => now()->format('d M Y, h:i A'),
        ])
        ->setPaper('a4', 'portrait')
        ->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return $pdf->stream(
            'product-' . $product->id . '.pdf',
            ['Attachment' => false]
        );
    }
}
