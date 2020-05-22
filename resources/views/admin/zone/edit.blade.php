@extends('admin.layout.base')

@section('title', 'Update  Zone ')

@section('content')


<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <!-- <a href="{{ route('admin.zone.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a> -->

			<h5 style="margin-bottom: 2em;"><span class="s-icon"><i class="ti-zoom-in"></i></span>&nbsp;Update  Zone</h5><hr>

            <!--form class="form-horizontal" action="{{route('admin.zone.update', $zone->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
				<div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">Zone Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $zone->name }}" name="name" required id="name" placeholder="Zone Name">
					</div>
				</div>

                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Zone Type</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $zone->type }}" name="type" required id="type" placeholder="Zone Type">
                    </div>
                </div>

             <div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">Country </label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $zone->county }}" name="county" required id="country" placeholder="Country">
					</div>
				</div>

                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Province</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $zone->province }}" name="province" required id="province" placeholder="Province">
                    </div>
                </div>


                <div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">Province Code </label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $zone->province_code }}" name="province_code" required id="province_code" placeholder="Province code">
					</div>
				</div>

                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Postcode area</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $zone->postcode_area }}" name="postcode_area" required id="province" placeholder="Postcode area">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="name" class="col-xs-2 col-form-label">Area Code</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $zone->area_code }}" name="area_code" required id="area_code" placeholder="Area Code">
                    </div>
                </div>

	 <div class="form-group row">
                    <label for="Latitude" class="col-xs-2 col-form-label">Latitude</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $zone->latitude }}" name="latitude" required id="latitude" placeholder="Latitude">
                    </div>
                </div>
				 <div class="form-group row">
                    <label for="Longitude" class="col-xs-2 col-form-label">Longitude</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $zone->longitude }}" name="longitude" required id="longitude" placeholder="Longitude">
                    </div>
                </div>
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Zone</button>
						<a href="{{route('admin.zone.index')}}" class="btn btn-default">Cancel</a>
						
					</div>
				</div>
			</form-->
		</div>
    </div>
</div>

@endsection
