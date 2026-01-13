<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductPdfController extends Controller
{
    public function show($id)
    {
        $product = Product::with('brands')->findOrFail($id);

        $this->authorize('viewPdf', $product);

        $totalPrice = $product->brands->sum('price');

        $pdf = Pdf::loadView('pdf.product', [
            'product'     => $product,
            'totalPrice'  => $totalPrice,
            'generatedAt' => now()->format('d M Y, h:i A'),
        ]);

        return $pdf->stream(
            'product-' . $product->id . '.pdf',
            ['Attachment' => false]
        );
    }
}
