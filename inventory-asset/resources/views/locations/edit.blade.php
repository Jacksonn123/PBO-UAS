@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Locations</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Locations</a></li>
                <li class="breadcrumb-item active">Edit Location</li>
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
        <form class="form-horizontal" method="POST" action="{{ route('locations.update', $data->id) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <input type="hidden" class="form-control" name="asset_no" id="asset_no" placeholder="Assets Number" value="{{ old('asset_no',$data->asset_no) }}">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Assets No</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="asset_nom" id="asset_nom" placeholder="Assets Number" value="{{ old('asset_no',$data->asset_no) }}" disabled>
                        @error('asset_no')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location" value="{{ old('location',$data->location) }}">
                        @error('location')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Save</button>
                <a href="{{ route('locations.index') }}" class="btn btn-danger">Back</a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div> <!-- /.card -->
</div>
@stop
