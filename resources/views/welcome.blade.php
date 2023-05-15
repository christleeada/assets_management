<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    

</head>
<body>
<style>
    .custom-navbar {
        background-color: #5a738e;
    }
</style>

<nav class="navbar navbar-expand navbar-dark custom-navbar">
    <a class="navbar-brand" href="#">CCS Assets</a>
    <div class="ml-auto">
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
</nav>

    <div class="container mt-4">
        
        <div class="table-responsive">
        <table id="itemTableForGuest" class="table table-striped jambo_table bulk_action">
                    <div><div>Export options</div>
                    @csrf
                    <a href="{{ route('item.csv') }}" class="btn btn-success m-1 btn-sm rounded">CSV</a>
                    <span style="padding-left: 10px;" ></span>
                    <a  href="{{ route('item.pdf') }}" class="btn btn-info m-1 btn-sm rounded">PDF</a>
                    <span style="padding-left: 10px;" ></span>
                    <a href="{{ route('item.print') }}" class="btn btn-primary m-1 btn-sm rounded">Print</a></div>
                <thead>
                    <tr class="headings">
                        <th class="column-title">QR Code</th>
                        <th class="column-title">Name</th>
                        <th class="column-title">Price</th>
                        <th class="column-title">Category</th>
                        <th class="column-title">Quantity</th>
                        <th class="column-title">Unit Type</th>
                        <th class="column-title">Date Purchased</th>
                        <th class="column-title">Date Added</th>
                        <th class="column-title">Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $value)
                    <tr class="even pointer" onclick="window.location='{{ route('item.show', $value->id) }}'">
                        <td><img class="qr-code" src="data:image/png;base64,{{ $value->qrcode_image }}" alt="QR Code" style="height:80px;width:80px;"></td>
                        <td class="">{{ $value->item_name }}</td>
                        <td class="">₱{{ $value->price }}</td>
                        <td class="">{{ $value->itemCategory->item_category }}</td>
                        <td class="">{{ $value->quantity }}</td>
                        <td class="">{{ $value->unitType->unit_type }}</td>
                        <td class="">{{ $value->date_purchased }}</td>
                        <td class="">{{ $value->created_at }}</td>
                        <td class=""><span class="badge badge-secondary">{{ $value->status->status }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
    <script>
    $(document).ready(function(){
        $('#itemTableForGuest').DataTable();
    });

    setTimeout(function(){
        $('#alert').fadeOut('fast');
    }, 5000);

</script>
</body>
</html>