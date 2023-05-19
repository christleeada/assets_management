<!DOCTYPE html>
<html>
<head>
    <title>Print QR Codes</title>
    <style>
        .qr-code-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: auto;
            align-items: auto;
            gap: 20px;
        }

        .qr-code {
            max-width: 100px;
            max-height: 100px;
        }

        .item-name {
            text-align: auto;
            font-size: 12px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="title">QR Codes</div>
    <div class="qr-code-container">
        @foreach($data as $value)
            <div>
                <img class="qr-code" src="data:image/png;base64,{{ $value->qrcode_image }}" alt="QR Code">
                <div class="item-name">{{ $value->item_name }}</div>
            </div>
        @endforeach
    </div>
</body>
</html>
