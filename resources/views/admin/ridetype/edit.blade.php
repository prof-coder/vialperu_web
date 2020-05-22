@extends('admin.layout.base')

@section('title', 'Update Ride Type ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
           <h5 style="margin-bottom: 2em;"><i class="ti-car"></i>&nbsp;Update Ride Type</h5><hr>

            <form class="form-horizontal" action="{{route('admin.ridetype.update', $ride->id )}}" method="POST" enctype="multipart/form-data" role="form" file="true">
                {{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
                <div class="form-group row">
                    <label for="name" class="col-xs-12 col-form-label">Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $ride->name }}" name="name" required id="name" placeholder="Cab Name">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="picture" class="col-xs-12 col-form-label">Icon</label>
                    <div class="col-xs-10">
                        @if($ride->icon) 
                                <img src="{{   url('/'. $ride->icon ) }}" style="height: 50px" >
                            @else
                                N/A
                            @endif
                        <input type="file" accept="image/*" name="icon" class="dropify form-control-file" id="icon" aria-describedby="fileHelp">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-10">
                        <select class="form-control" name="status" required="">
							<option value=""> Please Select </option>
							<option value="1" {{($ride->status == 1)?'selected':''}}>Active</option>
							<option value="0" {{($ride->status == 0)?'selected':''}}>Inactive</option>
						
						</select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <button type="submit" class="btn btn-success shadow-box btn-block" >Update</button>
                            </div>
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <a href="{{ route('admin.ridetype.index') }}" class="btn btn-danger shadow-box btn-block">Cancel</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
