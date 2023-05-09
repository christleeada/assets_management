
<!DOCTYPE html>
<html>
<head>
    <title>Items Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }.qr-code {
            max-width: 50px;
            max-height: 50px;
        }
        
    </style>
</head>
<body>
    <div class="title">Items Report</div>
    <table>
        <thead>
            <tr>
                <th>QR Code</th>
                <th>Name</th>
                <th>SKU No</th>
                <th>UPC No</th>
                <th>Price</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Unit Type</th>
                <th>Date Purchased</th>
                <th>Date Added</th>
                <th>Last Checked</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $value)
                <tr>
                <td><img class="qr-code" src="data:image/png;base64,{{ $value->qrcode_image }}" alt="QR Code"></td>
                    <td>{{ $value->item_name }}</td>
                    <td>{{ $value->sku_no }}</td>
                    <td>{{ $value->upc_no }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->itemCategory->item_category }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ $value->unitType->unit_type }}</td>
                    <td>{{ $value->date_purchased }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>{{ $value->maintenanced_date }}</td>
                    <td>{{ $value->status->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>


