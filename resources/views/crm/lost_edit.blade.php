
@extends('crm.layout.base')

@section('title', 'lost details ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h5 style="margin-bottom: 2em;"><span class="s-icon"><i class="ti-pie-chart"></i></span> Lost Details</h5>
            <hr>
            
            <div class="row">
                
                <div class="col-md-12">
                    <dl class="row">
                        
                        <dt class="col-sm-4">Name :</dt>
                        <dd class="col-sm-8">{{ @$data->name }}</dd>
                        <dt><hr></dt>
                        
                        <dt class="col-sm-4">Email :</dt>
                        <dd class="col-sm-8">{{ @$data->email }}</dd>
                        <dt><hr></dt>
                        
                        <dt class="col-sm-4">Phone :</dt>
                        <dd class="col-sm-8">{{ @$data->phone }}</dd>
                        <dt><hr></dt>
                        
                        <dt class="col-sm-4">Lost Item :</dt>
                        <dd class="col-sm-8">{{ @$data->lost_item }}</dd>
                        <dt><hr></dt>
                        
                        <dt class="col-sm-4">subject :</dt>
                        <dd class="col-sm-8">{{ @$data->subject }}</dd>
                        <dt><hr></dt>
                        
                        <dt class="col-sm-4">Description :</dt>
                        <dd class="col-sm-8">{{ @$data->description }}</dd>
                        <dt><hr></dt>
                        
                        <form action="{{ route('crm.lost-update', $data->id) }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH"/>
                        
                        <dt class="col-sm-4">Status :</dt>
                        <dd class="col-sm-8">
                        <select class="form-control" name="status" required="">
							<option value=""> Please Select </option>
							<option value="PENDING" {{($data->status == 'PENDING')?'selected':''}}>Pending</option>
							<option value="SOLVED" {{($data->status == 'SOLVED')?'selected':''}}>Solved</option>
						
						</select>
                        </dd>
                        <div class="form-group row">
        					<label for="zipcode" class="col-xs-3 col-form-label"></label>
        					<div class="col-xs-8">
        						<button type="submit" class="btn btn-success shadow-box">Update</button>
        						<a href="{{route('crm.lost-management')}}" class="btn btn-default">Cancel</a>
        					</div>
        				</div>
                        </form>
                    </dl>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection

