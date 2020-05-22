@extends('cms.layout.base')



@section('title', 'Add Testimonial ')



@section('content')



<div class="content-area py-1">

    <div class="container-fluid">

    	<div class="box box-block bg-white">

            <!-- <a href="{{ route('cms.testimonial.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a> -->



			<h5 style="margin-bottom: 2em;"><i class="ti-themify-favicon"></i>&nbsp;Add Testimonial</h5><hr>



            <form class="form-horizontal" action="{{route('cms.testimonial.store')}}" method="POST" enctype="multipart/form-data" role="form">

            	{{csrf_field()}}

				<div class="form-group row">

					<label for="name" class="col-xs-2 col-form-label">Name</label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ old('name') }}" name="name" required id="name" placeholder="Name">

					</div>

				</div>

				<div class="form-group row">

					<label for="name" class="col-xs-2 col-form-label">Name  <small>French</small></label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ old('name1') }}" name="name1" id="name1" placeholder="Name">

					</div>

				</div>

				

				<div class="form-group row">

					<label for="type" class="col-xs-2 col-form-label">Type</label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ old('type') }}" name="type" required id="type" placeholder="Enter business type">

					</div>

				</div>

				<div class="form-group row">

					<label for="type" class="col-xs-2 col-form-label">Type <small>French</small></label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ old('type1') }}" name="type1" id="type" placeholder="Enter business type">

					</div>

				</div>

                <div class="form-group row">

					<label for="image" class="col-xs-2 col-form-label">Picture</label>

					<div class="col-xs-10">

						<input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">

					</div>

				</div>

				<div class="form-group row">

					<label for="expiration" class="col-xs-2 col-form-label">Testimonial</label>

					<div class="col-xs-10">

                        <textarea class="form-control"  cols="2" rows="10" name="description" required id="description"  placeholder="Description" >{{ old('description') }}</textarea>

					</div>

				</div>

				<div class="form-group row">

					<label for="expiration" class="col-xs-2 col-form-label">Testimonial <small>French</small></label>

					<div class="col-xs-10">

                        <textarea class="form-control"  cols="2" rows="10" name="description1"  id="description1"  placeholder="Description" >{{ old('description1') }}</textarea>

					</div>

				</div>

				



				<div class="form-group row">

					<label for="zipcode" class="col-xs-2 col-form-label"></label>

					<div class="col-xs-10">

						<button type="submit" class="btn btn-success shadow-box">Add Testimonial</button>

						<a href="{{route('cms.testimonial.index')}}" class="btn btn-default">Cancel</a>

					</div>

				</div>

			</form>

		</div>

    </div>

</div>



@endsection

