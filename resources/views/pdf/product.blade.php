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

        .header h2 {
            margin: 0;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f5f5f5;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0;
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

    <table class="info-table">
        <tr>
            <td><strong>Product Name:</strong></td>
            <td>{{ $product->product_name }}</td>
        </tr>
        <tr>
            <td><strong>Description:</strong></td>
            <td>{{ $product->product_description }}</td>
        </tr>
    </table>

    <h4>Brands</h4>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Brand Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->brands as $index => $brand)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>{{ number_format($brand->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="total">Total</td>
                <td>{{ number_format($totalPrice, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} Your Company Name</p>
    </div>

</body>
</html>
