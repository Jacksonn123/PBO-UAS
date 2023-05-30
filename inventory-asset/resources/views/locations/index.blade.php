@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Locations</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Locations</li>
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
            <a href="{{ route('locations.create') }}"><button class="btn btn-sm btn-primary" >Add New Location</button></a>

          </div>
          <!-- /.card-header -->
          <div class="card-body ">
            <table class="table table-bordered table-striped yajra-datatable">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Asset No</th>
                    <th>Location</th>
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
        ajax: "{{ route('location.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'asset_no', name: 'asset_no'},
            {data: 'location', name: 'location'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });
  function hapus(e) {
      var url = '{{ route("maintenances.destroy", ":id") }}';
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
@stop
