@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">On Life Time</h4>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <form id="exportFormOn" action="/export" method="POST">
                                @csrf
                                <input type="hidden" name="assets" id="assetsArrayOn">
                                <button type="submit" class="btn btn-success" id="printPDFOn">Export PDF</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped on-datatable">
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Over Life Time</h4>
                    <div class="row">
                        <div class="col-6">
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <form id="exportFormOver" action="/export" method="POST">
                                @csrf
                                <input type="hidden" name="assets" id="assetsArrayOver">
                                <button type="submit" class="btn btn-success" id="printPDFOver">Export PDF</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped over-datatable">
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
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
    @section('js')
    <script type="text/javascript">
        $(function () {
            var table = $('.on-datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('home.on') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'asset_no', name: 'asset_no'},
                    {data: 'description', name: 'description'},
                    {data: 'acquisition', name: 'acquisition'},
                    {data: 'document', name: 'document'},
                    {data: 'serial_no', name: 'serial_no'},
                    {data: 'price', name: 'price'},
                    {data: 'tax_date_line', name: 'tax_date_line'},
                    {data: 'tax_price', name: 'tax_price'},
                    {data: 'wto_date_line', name: 'wto_date_line'},
                    {data: 'wto_price', name: 'wto_price'},
                    {data: 'life_time', name: 'life_time'},
                    {data: 'depreciation', name: 'depreciation'},
                    {data: 'location_of_document', name: 'location_of_document'},
                    {data: 'location_of_asset', name: 'location_of_asset'},
                    {data: 'size', name: 'size'},
                    {data: 'unit', name: 'unit'},
                    {data: 'condition', name: 'condition'},
                    {data: 'responsible_person', name: 'responsible_person'},
                    {data: 'remarks', name: 'remarks'},
                    {data: 'kategori', name: 'kategori'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });


            function generatePDF() {
                return new Promise(function(resolve, reject) {
                    let rows = table.rows({ search: "applied" }).data().toArray();

                    let tableData = [];
                    $.each(rows, function (index, rowData) {
                        var tableRow = [];
                        $.each(rowData, function (key, value) {
                            tableRow.push(value);
                        });
                        tableData.push(tableRow);
                    });
                    for (let i = 0; i < tableData.length; i++) {
                        tableData[i].pop();
                        tableData[i].pop();
                        tableData[i].pop();
                        tableData[i].pop();
                    }
                    let arrayDataInput = document.getElementById('assetsArrayOn');
                    arrayDataInput.value = JSON.stringify(tableData);
                    console.log(tableData);
                    $("#exportFormOn").submit();

                    resolve(); // Resolve the promise once the submission is complete
                });
            }

            $("#printPDFOn").on("click", async function(event) {
                event.preventDefault(); // Prevent default form submission

                await generatePDF(); // Await the completion of the generatePDF function

                // The PDF generation and form submission are complete
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            var table = $('.over-datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('home.over') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'asset_no', name: 'asset_no'},
                    {data: 'description', name: 'description'},
                    {data: 'acquisition', name: 'acquisition'},
                    {data: 'document', name: 'document'},
                    {data: 'serial_no', name: 'serial_no'},
                    {data: 'price', name: 'price'},
                    {data: 'tax_date_line', name: 'tax_date_line'},
                    {data: 'tax_price', name: 'tax_price'},
                    {data: 'wto_date_line', name: 'wto_date_line'},
                    {data: 'wto_price', name: 'wto_price'},
                    {data: 'life_time', name: 'life_time'},
                    {data: 'depreciation', name: 'depreciation'},
                    {data: 'location_of_document', name: 'location_of_document'},
                    {data: 'location_of_asset', name: 'location_of_asset'},
                    {data: 'size', name: 'size'},
                    {data: 'unit', name: 'unit'},
                    {data: 'condition', name: 'condition'},
                    {data: 'responsible_person', name: 'responsible_person'},
                    {data: 'remarks', name: 'remarks'},
                    {data: 'kategori', name: 'kategori'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });


            function generatePDF() {
                return new Promise(function(resolve, reject) {
                    let rows = table.rows({ search: "applied" }).data().toArray();

                    let tableData = [];
                    $.each(rows, function (index, rowData) {
                        var tableRow = [];
                        $.each(rowData, function (key, value) {
                            tableRow.push(value);
                        });
                        tableData.push(tableRow);
                    });
                    for (let i = 0; i < tableData.length; i++) {
                        tableData[i].pop();
                        tableData[i].pop();
                        tableData[i].pop();
                        tableData[i].pop();
                    }
                    let arrayDataInput = document.getElementById('assetsArrayOver');
                    arrayDataInput.value = JSON.stringify(tableData);
                    console.log(tableData);

                    $("#exportFormOver").submit();

                    resolve(); // Resolve the promise once the submission is complete
                });
            }

            $("#printPDFOver").on("click", async function(event) {
                event.preventDefault(); // Prevent default form submission

                await generatePDF(); // Await the completion of the generatePDF function

                // The PDF generation and form submission are complete
            });
        });

    </script>
@stop
