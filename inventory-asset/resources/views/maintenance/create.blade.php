@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add New Maintenances</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Maintenances</a></li>
                <li class="breadcrumb-item active">Add New Maintenance</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-info">
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('maintenances.store') }}">
            @csrf
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Assets</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="asset_no">
                            <option value="">Choose Assets</option>
                            @foreach($assets as $as)
                            <option value="{{ $as->asset_no }}">{{ $as->asset_no }}</option>
                            @endforeach
                        </select>
                        @error('asset_no')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Maintenance Info</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="info" id="info" placeholder="Maintenance info" value="{{ old('info') }}">
                        @error('info')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Save</button>
                <a href="{{ route('maintenances.index') }}" class="btn btn-danger">Back</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div> <!-- /.card -->
</div>
@stop
