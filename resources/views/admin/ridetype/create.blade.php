@extends('admin.layout.base')

@section('title', 'Add Service Type ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <!-- <a href="{{ route('admin.service.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a> -->

            <h5 style="margin-bottom: 2em;"><i class="ti-car"></i>&nbsp;Add Ride Type</h5><hr>

            <form class="form-horizontal" action="{{route('admin.ridetype.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="name" class="col-xs-12 col-form-label">Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('name') }}" name="name" required id="name" placeholder="Name">
                    </div>
                </div>

                

                <div class="form-group row">
                    <label for="picture" class="col-xs-12 col-form-label">Icon</label>
                    <div class="col-xs-10">
                        <input type="file" accept="image/*" name="icon" class="dropify form-control-file" id="icon" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <button type="submit" class="btn btn-success shadow-box btn-block">Add Ride Type</button>
                            </div>
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <a href="{{ route('admin.ridetype.index') }}" class="btn btn-danger btn-block shadow-box">Cancel</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
