@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Role</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
          <li class="breadcrumb-item active">Edit Roles</li>
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
	  <form class="form-horizontal" method="POST" action="{{ route('roles.update', $data->id) }}">
	  	@csrf
	  	@method('PUT')
	    <div class="card-body">
	      <div class="form-group row">
	        <label for="nama" class="col-sm-2 col-form-label">Name</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name', $data->name) }}">
	        @error('name')
	            <p class="text-danger">{{ $message }}</p>
	        @enderror
	        </div>
	      </div>
	    </div>
	    <!-- /.card-body -->
	    <div class="card-footer">
	      <button type="submit" class="btn btn-info">Save</button>
	      <a href="{{ route('roles.index') }}" class="btn btn-danger">Back</a>
	    </div>
	    <!-- /.card-footer -->
	  </form>
	</div>	            <!-- /.card -->
</div>
@stop