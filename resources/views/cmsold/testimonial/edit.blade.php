@extends('cms.layout.base')



@section('title', 'Update Testimonial')



@section('content')



<div class="content-area py-1">

    <div class="container-fluid">

    	<div class="box box-block bg-white">

            <!-- <a href="{{ route('cms.testimonial.index', $testimonial->id ) }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a> -->



			<h5 style="margin-bottom: 2em;"><i class="ti-themify-favicon"></i>&nbsp;Add Testimonial</h5><hr>



            <form class="form-horizontal" action="{{route('cms.testimonial.update', $testimonial->id )}}" method="POST" enctype="multipart/form-data" role="form">

            	{{csrf_field()}}

                <input type="hidden" name="_method" value="PATCH">

				<div class="form-group row">

					<label for="name" class="col-xs-2 col-form-label">Name</label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ $testimonial->name }}" name="name" required id="name" placeholder="Name">

					</div>

				</div>

				<div class="form-group row">

					<label for="name" class="col-xs-2 col-form-label">Name</label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ $testimonial->name1 }}" name="name1" id="name1" placeholder="Name">

					</div>

				</div>

				

				<div class="form-group row">

					<label for="type" class="col-xs-2 col-form-label">Type</label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ $testimonial->type }}" name="type" required id="type" placeholder="Enter business type">

					</div>

				</div>

				<div class="form-group row">

					<label for="type" class="col-xs-2 col-form-label">Type <small>French</small></label>

					<div class="col-xs-10">

						<input class="form-control" type="text" value="{{ $testimonial->type1 }}" name="type1" id="type1" placeholder="Enter business type">

					</div>

				</div>

                <div class="form-group row">

					<label for="image" class="col-xs-2 col-form-label">Picture</label>

					<div class="col-xs-10">

                        @if(isset($testimonial->image) )

                            <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{ asset('storage/app/public/'.$testimonial->image ) }}">

                        @endif

                        <input type="hidden" name="tst_image" value="{{ $testimonial->image }}" />

						<input type="file" accept="image/*" name="image"  class="dropify form-control-file" id="image" aria-describedby="fileHelp">

					</div>

				</div>

				<div class="form-group row">

					<label for="expiration" class="col-xs-2 col-form-label">Testimonial</label>

					<div class="col-xs-10">

                        <textarea class="form-control"  cols="2" rows="10" name="description" required id="description"  placeholder="Description" >{{ $testimonial->description }}</textarea>

					</div>

				</div>

				<div class="form-group row">

					<label for="expiration" class="col-xs-2 col-form-label">Testimonial <small>French</small></label>

					<div class="col-xs-10">

                        <textarea class="form-control"  cols="2" rows="10" name="description1" id="description1"  placeholder="Description" >{{ $testimonial->description1 }}</textarea>

					</div>

				</div>

				



				<div class="form-group row">

					<label for="zipcode" class="col-xs-2 col-form-label"></label>

					<div class="col-xs-10">

						<button type="submit" class="btn btn-success shadow-box">Update Testimonial</button>

						<a href="{{route('cms.testimonial.index')}}" class="btn btn-default">Cancel</a>

					</div>

				</div>

			</form>

		</div>

    </div>

</div>



@endsection

