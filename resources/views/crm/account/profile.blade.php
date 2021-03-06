@extends('crm.layout.base')

@section('title', 'Update Profile ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;"><i class="ti-write"></i>&nbsp;Update Profile</h5><hr>

            <form class="form-horizontal" action="{{route('crm.profile.update')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}

				<div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Auth::guard('crm')->user()->name }}" name="name" required id="name" placeholder=" Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-xs-2 col-form-label">Email</label>
					<div class="col-xs-10">
						<input class="form-control" type="email" required name="email" value="{{ isset(Auth::guard('crm')->user()->email) ? Auth::guard('crm')->user()->email : '' }}" id="email" placeholder="Email">
					</div>
				</div>

				<div class="form-group row">
					<label for="mobile" class="col-xs-2 col-form-label">Mobile</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" required name="mobile" value="{{ isset(Auth::guard('crm')->user()->mobile) ? Auth::guard('crm')->user()->mobile : '' }}" id="mobile" placeholder="Mobile">
					</div>
				</div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-success shadow-box">Update Profile</button>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
