@extends('admin.layout.base')

@section('title', 'Site Settings ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
			<h5>Fare Settings</h5>
<!--{{ route('admin.fare.settings.store') }}-->
            <form class="form-horizontal"  action="{{url('/admin/edit_fare_action')}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
					<input class="form-control" type="hidden" value="{{$data->id}}" name="id">
            		<div class="form-group row">
					<label for="site_title" class="col-xs-2 col-form-label">Fare Plan Name</label> 
					<div class="col-xs-10">
					   <input class="form-control" type="text" value="{{$data->fare_plan_name}}" name="fare_plan_name" required id="fare_plan_name" placeholder="Fare Plan Name">
					</div>
				</div>

				<div class="form-group row">
					<label for="site_title" class="col-xs-2 col-form-label">Start KM</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{$data->from_km}}" name="from_km" required id="from_km" placeholder="enter in digit (0)" onkeypress="javascript:return isValid(this,event)">
					</div>
				</div>

			
                <div class="form-group row">
                    <label for="tax_percentage" class="col-xs-2 col-form-label">Upto KM</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{$data->upto_km}}" name="upto_km" id="upto_km" placeholder="enter in digit (3)" onkeypress="javascript:return isValid(this,event)">
                    </div>
                </div>

				<div class="form-group row">
					<label for="store_link_android" class="col-xs-2 col-form-label">Price Per KM</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{$data->price_per_km}}" name="price_per_km"  id="price_per_km" onkeypress="javascript:return isValid(this,event)">
					</div>
				</div>

				<div class="form-group row">
					<label for="store_link_ios" class="col-xs-2 col-form-label">Price Per Minute</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{$data->waiting_price_per_min}}" name="waiting_price_per_min"  id="waiting_price_per_min" placeholder="4" onkeypress="javascript:return isValid(this,event)">
					</div>
				</div>
				
				
				<div class="form-group row">
					<label for="store_link_ios" class="col-xs-2 col-form-label">Is Rental</label>
					<div class="col-xs-4">
						<select name="is_rental" required="required" id="is_rental" class="form-control">
							<option value=''>Choose</option>
							<option value='1' {{$data->is_rental==1?'selected':''}}>Yes</option>
							<option value='0' {{$data->is_rental==0?'selected':''}}>No</option>
						</select>
					</div>
				</div>
				<div class="form-group row" id="minutesdiv"></div>

				<div class="form-group row">
					<label for="store_link_ios" class="col-xs-2 col-form-label">Apply Peak Fare</label>
					<div class="col-xs-10">
						<select class="form-control" id="peak_hour" name="peak_hour">
							@if($data->peak_hour == 'NO')
								<option value="NO" selected>NO</option>
								<option value="YES">YES</option>
							@else
								<option value="NO">NO</option>
								<option value="YES" selected>YES</option>
							@endif
						</select>
					</div>
				</div>

                 <span class="peakHide" style="">   
                     
                <div class="form-group row" style="margin-left: -32px;font-size: 15px;font-weight: bold;">
					<label for="store_link_ios" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
					   <label for="store_link_ios" class="col-xs-2 col-form-label">Peak Fare Details</label>
					</div>
				</div>
				<?php $i=0; ?>
                    @foreach($data->peakNight as $key => $val)
                    @if($val->peak_night_type=='PEAK')

                	<div class="form-group row">
					   <label for="store_link_ios" class="col-xs-2 col-form-label"></label>
					    <div class="col-xs-2">
							<select  class="form-control validation" id="peak_day" name="peak_day[]">
	                        <option value="">Day</option>
		                        @foreach(explode(',', env('DAY')) as $d=>$dv)
		                           <option value="{{$dv}}" <?php if($val->day==$dv) echo 'selected'; ?>>{{$dv}} </option>
		                         @endforeach
	                        </select>
					    </div>
						<div class="col-xs-2">
							<!-- <select  class="form-control" id="peak_start_time" name="peak_start_time[]">
	                        <option>Start Time</option>
		                        @foreach(explode(',', env('HOUR')) as $d=>$dv)
		                           <option value="{{$dv}}" <?php if($val->start_time==$dv) echo 'selected'; ?>>{{$dv}} </option>
		                        @endforeach
	                         </select> -->
	                           <input type="time" value="{{$val->fare_in_percentage !=''?$val->start_time:''}}" class="form-control validation" id="peak_start_time" name="peak_start_time[]">
					    </div>
						<div class="col-xs-2">
							<!-- <select  class="form-control" id="peak_end_time" name="peak_end_time[]">
                            <option>End Time</option>
	                            @foreach(explode(',', env('HOUR')) as $d=>$dv)
	                               <option value="{{$dv}}" <?php if($val->end_time==$dv) echo 'selected'; ?>>{{$dv}} </option>
	                            @endforeach
                            </select> -->
                            <input type="time" value="{{$val->fare_in_percentage !=''?$val->end_time:''}}" class="form-control validation" id="peak_end_time" name="peak_end_time[]">
					    </div>
					 
						<div class="col-xs-2">
						  <input class="form-control validation" type="text" value="{{$val->fare_in_percentage}}" name="peak_fare[]" id="peak_fare" placeholder="Peak Fare(%)">
					    </div>
					
					    <div class="col-xs-2">
					   	     @if($i=='0')
						       <button type="button" class="btn btn-primary" id="peak_data">+</button>
						     @else
	                           <button type="button" class="btn btn-primary" onclick="removeRow(this)">-</button>
						     @endif
						</div>
				    </div>
				    <?php $i++; ?>
				    @endif
      			    @endforeach
	      			@if($data->peak_hour == 'NO')
				    <span class="peakHide" style="display: none">   
	                <div class="form-group row">
						<label for="store_link_ios" class="col-xs-2 col-form-label"></label>
						<div class="col-xs-2">
							<select  class="form-control peak_day validation" name="peak_day[]" id="peak_day">
		                        <option value="">Day</option>
			                        @foreach(explode(',', env('DAY')) as $d=>$dv)
			                          <option value="{{$dv}}">{{$dv}} </option>
			                         @endforeach
	                         </select>
						</div>
						<div class="col-xs-2">
							<!-- <select  class="form-control" name="peak_start_time[]" id="peak_start_time">
		                        <option>Start Time</option>
			                        @foreach(explode(',', env('HOUR')) as $d=>$dv)
			                          <option value="{{$dv}}">{{$dv}} </option>
			                         @endforeach
	                         </select> -->
	                         <input type="time" class="form-control validation" name="peak_start_time[]" id="peak_start_time">
						</div>
							<div class="col-xs-2">
								<!-- <select  class="form-control" name="peak_end_time[]" id="peak_end_time">
	                            <option>End Time</option>
		                        @foreach(explode(',', env('HOUR')) as $d=>$dv)
		                         <option value="{{$dv}}">{{$dv}} </option>
		                         @endforeach
	                         </select> -->
	                         <input type="time" class="form-control validation" name="peak_end_time[]" id="peak_end_time">
						</div>
						<div class="col-xs-2">
							<input class="form-control validation" type="text" value="" name="peak_fare[]" id="peak_fare" placeholder="Peak Fare(%)">
						</div>
						<div class="col-xs-2">
						    <button type="button" class="btn btn-primary" id="peak_data">+</button>
						</div>
					 </div>
									
	                </span>
	                  @endif
					<div  id="peakAdded">
						
					</div>
                     </span>
                     <br/>
					<div class="form-group row">
						<label for="store_link_ios" class="col-xs-2 col-form-label">Apply Night Fare</label>
						<div class="col-xs-10">
							<select class="form-control" id="night_hour" name="late_night">
								@if($data->late_night == 'NO') 
									<option value="NO" selected>NO</option>
									<option value="YES">YES</option>
								@else
									<option value="NO">NO</option>
									<option value="YES" selected>YES</option>
								@endif
							</select>
						</div>
					</div>

                       @foreach($data->peakNight as $val)
                    @if($val->peak_night_type=='NIGHT')
                    <span class="nightHide" style="">   
                    <div class="form-group row" style="margin-left: -32px;font-size: 15px;font-weight: bold;">
					<label for="store_link_ios" class="col-xs-2 col-form-label"></label>
						<div class="col-xs-10">
							<label for="store_link_ios" class="col-xs-2 col-form-label">Night Fare Details</label>
						</div>
				   </div>
                    
                	<div class="form-group row">
					<label for="store_link_ios" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-2">
						<!-- <select class="form-control" id="night_start_time" name="night_start_time">
                        <option>Start Time</option>
                        <option>End Time</option>
                            @foreach(explode(',', env('HOUR')) as $d=>$dv)
                         <option value="{{$dv}}" <?php if($val->start_time==$dv) echo 'selected'; ?>>{{$dv}} </option>
                         @endforeach
                        </select> -->
                        <input type="time" value="{{$val->fare_in_percentage!=''?$val->start_time:''}}" class="form-control validation1" id="night_start_time" name="night_start_time">
					</div>
					<div class="col-xs-2">
						<!-- <select class="form-control" id="night_end_time" name="night_end_time">
                            <option>End Time</option>
                             <option>End Time</option>
                            @foreach(explode(',', env('HOUR')) as $d=>$dv)
                         <option value="{{$dv}}" <?php if($val->end_time==$dv) echo 'selected'; ?>>{{$dv}} </option>
                         @endforeach
                         </select> -->
                         <input value="{{$val->fare_in_percentage!=''?$val->end_time:''}}" type="time" class="form-control validation1" id="night_end_time" name="night_end_time">
					</div>
					<div class="col-xs-2">
						<input class="form-control validation1" type="text" value="{{$val->fare_in_percentage}}" name="night_fare" id="night_fare" placeholder="Night Fare(%)">
					</div>
					
						<div class="col-xs-2">
					<!-- <button type="button" class="btn btn-primary" id="night_data">Add</button> -->
					</div>
				</div>
			    @endif
      			@endforeach
				@if($data->late_night == 'NO')
                <span class="nightHide" style="display: none;">   
                	<div class="form-group row">
					<label for="store_link_ios" class="col-xs-2 col-form-label"></label>
						<div class="col-xs-2">
						<!-- <select class="form-control" id="night_start_time" name="night_start_time">
                        <option>Start Time</option>
                        <option>End Time</option>
                         @foreach(explode(',', env('HOUR')) as $d=>$dv)
                         <option value="{{$dv}}">{{$dv}} </option>
                         @endforeach
                         </select> -->
                         <input type="time" class="form-control validation1" id="night_start_time" name="night_start_time">
					</div>
						<div class="col-xs-2">
							<!-- <select class="form-control" id="night_end_time" name="night_end_time">
                            <option>End Time</option>
                            <option>End Time</option>
							@foreach(explode(',', env('HOUR')) as $d=>$dv)
                            <option value="{{$dv}}">{{$dv}} </option>
                            @endforeach
                         </select> -->
                         <input type="time" class="form-control validation1" id="night_end_time" name="night_end_time">
					</div>
					<div class="col-xs-2">
						<input class="form-control validation1" type="text" value="" id="night_fare" name="night_fare" placeholder="Night Fare(%)">
					</div>
					
					<div class="col-xs-2">
					<!-- <button type="button" class="btn btn-primary" id="night_data">Add</button> -->
					</div>
				</div>
			                  
                     </span>
				@endif			         
			         <div  id="nightAdded">
						
					</div>
                  
                     </span>
                    
				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">						
						<button type="submit" class="btn btn-success shadow-box" id="alertbox">Update</button>
						<a href="{{route('admin.fare_settings')}}" class="btn btn-danger shadow-box">Cancel</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

			var html = '<label for="store_link_ios" class="col-xs-2 col-form-label">Time duration in minute</label>\
					<div class="col-xs-10">\
						<input class="form-control" required type="text" value="{{$data->minutes}}" name="minutes"  id="minute" placeholder="100" >\
					</div>';

			var ren = '{{$data->is_rental}}';
			
			if(ren==1){	
				$('#minutesdiv').html(html);
			}else{
				$('#minutesdiv').html('');
			}
			$("body").on("change","#is_rental",function(){
			var is_rental = $(this).val();
			if(is_rental!='' && is_rental=='1'){
				$('#minutesdiv').html(html);
			}else{
				$('#minutesdiv').html('');
			}
		});
	})
</script>
@endsection

