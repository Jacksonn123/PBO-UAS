@extends('adminlte::page')

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add New Asset</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admins.index') }}">Assets</a></li>
          <li class="breadcrumb-item active">Add New Asset</li>
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
	  <form class="form-horizontal" method="POST" action="{{ route('assets.store') }}">
	  	@csrf
	    <div class="card-body">
	      <div class="form-group row">
	        <label for="nama" class="col-sm-2 col-form-label">Asset No</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name="asset_no" id="asset_no" placeholder="ID" value="{{ old('asset_no') }}">
	        @error('asset_no')
	            <p class="text-danger">{{ $message }}</p>
	        @enderror
	        </div>
	      </div>

	      <div class="form-group row">
	        <label for="nama" class="col-sm-2 col-form-label">Description</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description') }}">
	        @error('description')
	            <p class="text-danger">{{ $message }}</p>
	        @enderror
	        </div>
	      </div>

	      <div class="form-group row">
	        <label for="nama" class="col-sm-2 col-form-label">Acquisition</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name="acquisition" id="acquisition" placeholder="Acquisition" value="{{ old('acquisition') }}">
	        @error('acquisition')
	            <p class="text-danger">{{ $message }}</p>
	        @enderror
	        </div>
	      </div>

          <div class="form-group row">
	        <label for="nama" class="col-sm-2 col-form-label">Document</label>
	        <div class="col-sm-10">
	          <input type="text" class="form-control" name="document" id="document" placeholder="Document" value="{{ old('document') }}">
	        @error('document')
	            <p class="text-danger">{{ $message }}</p>
	        @enderror
	        </div>
	      </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Serial No</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="serial_no" id="serial_no" placeholder="Serial No" value="{{ old('serial_no') }}">
                    @error('serial_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

          <div class="form-group row">
	        <label for="nama" class="col-sm-2 col-form-label">Price</label>
	        <div class="col-sm-10">
	          <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{ old('price') }}">
	        @error('price')
	            <p class="text-danger">{{ $message }}</p>
	        @enderror
	        </div>
	      </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Tax Date Line</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tax_date_line" id="tax_date_line" placeholder="Tax Date Line" value="{{ old('tax_date_line') }}">
                    @error('tax_date_line')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="tax_price" class="col-sm-2 col-form-label">Tax Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="tax_price" id="tax_price" placeholder="Tax Price" value="{{ old('tax_price') }}">
                    @error('tax_price')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="wto_date_line" class="col-sm-2 col-form-label">WTO Date Line</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="wto_date_line" id="wto_date_line" placeholder="WTO Date Line" value="{{ old('wto_date_line') }}">
                    @error('wto_date_line')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="wto_price" class="col-sm-2 col-form-label">WTO Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="wto_price" id="wto_price" placeholder="WTO Price" value="{{ old('wto_price') }}">
                    @error('wto_price')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="life_time" class="col-sm-2 col-form-label">Life Time</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="life_time" id="life_time" placeholder="Life Time" value="{{ old('life_time') }}">
                    @error('life_time')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="depreciation" class="col-sm-2 col-form-label">Depreciation</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="depreciation" id="depreciation" placeholder="Depreciation" value="{{ old('depreciation') }}">
                    @error('depreciation')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="location_of_document" class="col-sm-2 col-form-label">Location of Document</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="location_of_document" id="location_of_document" placeholder="Location of Document" value="{{ old('location_of_document') }}">
                    @error('location_of_document')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="location_of_asset" class="col-sm-2 col-form-label">Location of Asset</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="location_of_asset" id="location_of_asset" placeholder="Location of Asset" value="{{ old('location_of_asset') }}">
                    @error('location_of_asset')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="size" class="col-sm-2 col-form-label">Size</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="size" id="size" placeholder="Size" value="{{ old('size') }}">
                    @error('size')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit" value="{{ old('unit') }}">
                    @error('unit')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="condition" class="col-sm-2 col-form-label">Condition</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="condition" id="condition" placeholder="Condition" value="{{ old('condition') }}">
                    @error('condition')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="responsible_person" class="col-sm-2 col-form-label">Responsible Person</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="responsible_person" id="responsible_person" placeholder="Responsible Person" value="{{ old('responsible_person') }}">
                    @error('responsible_person')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks" value="{{ old('remarks') }}">
                    @error('remarks')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Kategori" value="{{ old('kategori') }}">
                    @error('kategori')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>



        </div>
	    <!-- /.card-body -->
	    <div class="card-footer">
	      <button type="submit" class="btn btn-info">Save</button>
	      <a href="{{ route('assets.index') }}" class="btn btn-danger">Back</a>
	    </div>
	    <!-- /.card-footer -->
	  </form>
	</div>	            <!-- /.card -->
</div>
@stop
