@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Assets</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Assets</li>
        </ol>
      </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif


    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
    </div>
    @endif

</div><!-- /.container-fluid -->
@stop

@section('content')

  <!-- Main content -->
<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
              <div class="row">
                  <div class="col-6">
                      <a href="{{ route('assets.create') }}"><button class="btn btn-sm btn-primary" > Add New Assets</button></a>
                  </div>
                  <div class="col-6 d-flex justify-content-end">
                      <form id="exportForm" action="/export" method="POST">
                          @csrf
                          <input type="hidden" name="assets" id="assetsArray">
                          <button type="submit" class="btn btn-success" id="printPDF">Export PDF</button>
                      </form>
                  </div>
              </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body ">
            <table class="table table-bordered table-striped yajra-datatable">
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
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
@stop

@section('js')
    <script type="text/javascript">
        $(function () {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('asset.list') }}",
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
                    let arrayDataInput = document.getElementById('assetsArray');
                    arrayDataInput.value = JSON.stringify(tableData);

                    $("#exportForm").submit();

                    resolve(); // Resolve the promise once the submission is complete
                });
            }

            $("#printPDF").on("click", async function(event) {
                event.preventDefault(); // Prevent default form submission

                await generatePDF(); // Await the completion of the generatePDF function

                // The PDF generation and form submission are complete
            });

        });

        function hapus(e) {
            var url = '{{ route("assets.destroy", ":id") }}';
            url = url.replace(':id', e);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title             : "Are You Sure ?",
                text              : "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",
                icon              : "warning",
                showCancelButton  : true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor : "#d33",
                confirmButtonText : "Yes!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url    : url,
                        type   : "delete",
                        success: function(data) {
                            $('.yajra-datatable').DataTable().ajax.reload();
                        }
                    })
                }
            })
        }
    </script>

{{--    <script type="text/javascript">--}}
{{--  $(function () {--}}

{{--    var table = $('.yajra-datatable').DataTable({--}}
{{--        processing: true,--}}
{{--        serverSide: true,--}}
{{--        scrollX: true,--}}
{{--        ajax: "{{ route('asset.list') }}",--}}
{{--        columns: [--}}
{{--            {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
{{--            {data: 'asset_no', name: 'asset_no'},--}}
{{--            {data: 'description', name: 'description'},--}}
{{--            {data: 'acquisition', name: 'acquisition'},--}}
{{--            {data: 'document', name: 'document'},--}}
{{--            {data: 'serial_no', name: 'serial_no'},--}}
{{--            {data: 'price', name: 'price'},--}}
{{--            {data: 'tax_date_line', name: 'tax_date_line'},--}}
{{--            {data: 'tax_price', name: 'tax_price'},--}}
{{--            {data: 'wto_date_line', name: 'wto_date_line'},--}}
{{--            {data: 'wto_price', name: 'wto_price'},--}}
{{--            {data: 'life_time', name: 'life_time'},--}}
{{--            {data: 'depreciation', name: 'depreciation'},--}}
{{--            {data: 'location_of_document', name: 'location_of_document'},--}}
{{--            {data: 'location_of_asset', name: 'location_of_asset'},--}}
{{--            {data: 'size', name: 'size'},--}}
{{--            {data: 'unit', name: 'unit'},--}}
{{--            {data: 'condition', name: 'condition'},--}}
{{--            {data: 'responsible_person', name: 'responsible_person'},--}}
{{--            {data: 'remarks', name: 'remarks'},--}}
{{--            {data: 'kategori', name: 'kategori'},--}}
{{--            {--}}
{{--                data: 'action',--}}
{{--                name: 'action',--}}
{{--                orderable: true,--}}
{{--                searchable: true--}}
{{--            },--}}
{{--        ]--}}
{{--    });--}}

{{--  });--}}
{{--  function hapus(e) {--}}
{{--      var url = '{{ route("assets.destroy", ":id") }}';--}}
{{--          url = url.replace(':id', e);--}}
{{--      $.ajaxSetup({--}}
{{--      headers: {--}}
{{--      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--      }--}}
{{--      });--}}
{{--        Swal.fire({--}}
{{--            title             : "Are You Sure ?",--}}
{{--            text              : "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",--}}
{{--            icon              : "warning",--}}
{{--            showCancelButton  : true,--}}
{{--            confirmButtonColor: "#3085d6",--}}
{{--            cancelButtonColor : "#d33",--}}
{{--            confirmButtonText : "Yes!"--}}
{{--        }).then((result) => {--}}
{{--            if (result.value) {--}}
{{--                $.ajax({--}}
{{--                    url    : url,--}}
{{--                    type   : "delete",--}}
{{--                    success: function(data) {--}}
{{--                      $('.yajra-datatable').DataTable().ajax.reload();--}}
{{--                    }--}}
{{--                })--}}
{{--            }--}}
{{--        })--}}
{{--    }--}}
{{--</script>--}}
@stop
