<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Product PDF</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: middle;
        }

        th {
            background-color: #f5f5f5;
            text-align: left;
        }

        .brand-image {
            width: 60px;
            height: auto;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Product Details</h2>
        <p>Generated on {{ $generatedAt }}</p>
    </div>

    <!-- Product Info -->


    <table>
        <tr>
            <th width="25%">Product Name</th>
            <td>{{ $product->product_name }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $product->product_description }}</td>
        </tr>
    </table>

    <!-- Brand Details -->
    <h4>Brand Details</h4>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Brand Name</th>
                <th width="25%">Image</th>
                <th width="20%">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->brands as $index => $brand)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $brand->brand_name }}</td>
                    <td>
                        @if ($brand->image)
                            <img src="{{ public_path('storage/' . $brand->image) }}" class="brand-image" alt="Brand Image">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ number_format($brand->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="total">Total Price</td>
                <td class="total">{{ number_format($totalPrice, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        © {{ date('Y') }} Jevin
    </div>

</body>

</html>
