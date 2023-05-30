<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table</title>
    <style>
        .container {
            margin-top: 5rem;
        }

        .text-center {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 0.5rem;
        }

        .table thead th {
            background-color: #f2f2f2;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Asset</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Asset No</th>
            <th>Description</th>
            <th>Asquisition</th>
            <th>Document</th>
            <th>Serial No </th>
            <th>Price</th>
            <th>Tax Date Line</th>
            <th>Tax Price </th>
            <th>WTO Date Line</th>
            <th>WTO Price</th>
            <th>Life Time</th>
            <th>Depreciation </th>
            <th>Location of Document</th>
            <th>Location of Asset</th>
            <th>Size</th>
            <th>Unit</th>
            <th>Condition </th>
            <th>Responsible Person</th>
            <th>Remarks</th>
            <th>Kategori</th>
        </tr>
        </thead>
        <tbody>
        @if($assets != null)
            @php
                $no = 1;
            @endphp
            @foreach ($assets as $asset)
                <tr>
                    <th>{{ $no++ }}</th>
                    @for($i = 1; $i < 21; $i++)
                        <th>{{ $asset[$i] }}</th>
                    @endfor

                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
