@extends('user.layout.base')
@section('title', 'My Trips ')
@section('content')
<style type="text/css">
	.fontsize{
		font-size: 14px;
	}
    .car-radio{
        width: 125px !important;
    }
</style>

<div class="col-md-12" style="margin-bottom: 20px;">

    <div class="dash-content">
        <div class="row no-margin">
            <div class="col-md-12">
                <h4 class="page-title"><!--@lang('user.ride.ride_now')--><span class="s-icon"></span>&nbsp; New Ride</h4>
            </div>
        </div>
        @include('common.notify')
        <div class="row no-margin pricing_left">
            <div class="col-md-6">
                <!--confirm/ride-->
                <form action="{{url('confirm/ride')}}" method="GET" onkeypress="return disableEnterKey(event);" class="tripsform">
                    
                    <div class="input-group dash-form" style="max-width:inherit">
                        <div class="input-group-addon"><span class="ti-control-record"></span></div>
                        <input type="text" class="form-control fontsize" id="origin-input" name="s_address"  placeholder="Enter pickup location" value="{{ session('s_address') }}">
                    </div>
                    <div class="input-group dash-form" style="max-width:inherit">
                        <div class="input-group-addon"><span class="ti-location-pin"></span></div>
                        <input type="text" class="form-control fontsize" id="destination-input" name="d_address"  placeholder="Enter drop location" value="{{ session('d_address') }}">
                    </div>
                    <input type="hidden" name="s_latitude" id="origin_latitude" value="{{ session('s_latitude') }}">
                    <input type="hidden" name="s_longitude" id="origin_longitude" value="{{ session('s_longitude') }}">
                    <input type="hidden" name="d_latitude" id="destination_latitude" value="{{ session('d_latitude') }}">
                    <input type="hidden" name="d_longitude" id="destination_longitude" value="{{ session('d_longitude') }}">
                    <input type="hidden" name="current_longitude" id="long" value="{{ @$_GET['current_longitude'] }}">
                    <input type="hidden" name="current_latitude" id="lat" value="{{ @$_GET['current_latitude'] }}">
					<input type="hidden" name="promo_code" id="promo_code" />

                    <div class="car-detail">
                        @foreach($services as $service)
                        <?php $i = 0;  ?>
                        <div class="car-radio">
                            <input type="radio" 
                                name="service_type"
                                value="{{ $service->id }}"
                                id="service_{{ $service->id }}"
                                @if (session('service_type') == $service->id) checked="checked" @endif>
                            <label for="service_{{$service->id}}">
                                <div class="car-radio-inner">
                                    
                                    <div class="img"><img src="{{image($service->image)}}"  class="{{ $i== 0 ? 'img_color ': ''}}"></div>
                                    <div class="name"><span class="{{ $i== 0 ? 'car_ser_type': ''}}">{{$service->name}}</span></div>
                                </div>
                            </label>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                    <!--<button type="submit"  class="full-primary-btn btn-success box-shadow fare-btn">@lang('user.ride.order_now')</button>-->
                    <button type="submit" class="half-primary-btn btn-success shadow-box fare-btn" style="width: 100% !important;">@lang('user.ride.order_now')</button>
                    <!-- <button type="button" class="half-secondary-btn fare-btn shadow-box" data-toggle="modal" data-target="#schedule_modal">@lang('user.ride.schedule_order')</button> -->
                </form>
            </div>

            <div class="col-md-6">
                <div class="map-responsive">
                    <div id="map" style="width: 100%; height: 450px;"></div>
                </div> 
            </div>
        </div>
    </div>

    <div class="dash-content" style="margin-top: 20px;">
        <div class="row no-margin">
            <div class="col-md-12">
                <h4 class="page-title">Recent Ride</h4>
            </div>
        </div>

        <div class="row no-margin ride-detail">
            <div class="col-md-12">
            @if($trips->count() > 0)

                <table class="table table-condensed" style="border-collapse:collapse;">
                    <thead>
                        <tr>
                            <!--th>&nbsp;</th-->
                            <th>@lang('user.booking_id')</th>
                            <th>@lang('user.date')</th>
                            <th>@lang('user.profile.name')</th>
                            <th>@lang('user.amount')</th>
                            <th>@lang('user.type')</th>
                            <th>@lang('user.payment')</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($trips as $trip)

                        <tr data-toggle="collapse" data-target="#trip_{{$trip->id}}" class="accordion-toggle collapsed">
                            <!--td><span class="arrow-icon fa fa-chevron-right"></span></td-->
                            <td>{{ $trip->booking_id }}</td>
                            <td>{{date('d-m-Y',strtotime($trip->assigned_at))}}</td>
                            @if($trip->provider)
                                <td>{{$trip->provider->first_name}} {{$trip->provider->last_name}}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($trip->payment)
                                <td>{{currency($trip->payment->total)}}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($trip->service_type)
                                <td>{{$trip->service_type->name}}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>@lang('user.paid_via') {{$trip->payment_mode}}</td>
                            <td>
                                <form action ="{{url('/mytrips/detail')}}">
                                    <input type="hidden" value="{{$trip->id}}" name="request_id">
                                    <button type="submit" style="margin-top: 0px;" class="full-primary-btn fare-btn">Detail</button>
                                </form>
                            </td>
                        </tr>
                       
                        @endforeach


                    </tbody>
                </table>
                @else
                    <hr>
                    <p style="text-align: center;">No Rides Available</p>
                @endif
            </div>
        </div>

    </div>
</div>
<!-- Schedule Modal -->
<div id="schedule_modal" class="modal fade schedule-modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Schedule a Order</h4>
      </div>
		<form>
			<div class="modal-body">
				<label>Date</label>
				<input value="{{date('m/d/Y')}}" type="text" id="datepicker" placeholder="Date" name="schedule_date">
				<label>Time</label>
				<input value="{{date('H:i')}}" type="text" id="timepicker" placeholder="Time" name="schedule_time">
			  </div>
			  <div class="modal-footer">
				<button type="button" id="schedule_button" class="half-primary-btn btn-success shadow-box" data-dismiss="modal" style="width: 522px;margin-right: 24px;">Schedule Order</button>
			</div>
		</form>
    </div>
  </div>
</div>
@endsection

@section('scripts')    
<script type="text/javascript" src="{{ asset('asset/front/js/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initMap" async defer></script>

<script type="text/javascript">
 $('.pricing_left .car-radio').on('click', function() {
   var detail = $('.car-detail');
   detail.find('input[type=radio]').attr('checked');
   detail.find('.car_ser_type').removeClass('car_ser_type');
   detail.find('.img_color').removeClass('img_color');
   $(this).find('img').addClass('img_color');
   $(this).find('span').addClass('car_ser_type');
   if($(':radio[name=service_type]:checked, :radio[name=service_type]:checked').length >= 1){
   $('input[name=service_type]').attr('checked', false); 

   } if($(':radio[name=service_type]:checked, :radio[name=service_type]:checked').length==0){
   	   $(this).find('input[type=radio]').attr('checked', 'checked');
   }
   
   });
//alert(document.getElementById('long').value);

        var ip_details = <?php echo json_encode( $ip_details );  ?>;

        var current_latitude = parseFloat(ip_details.geoplugin_latitude);
        var current_longitude = parseFloat(ip_details.geoplugin_longitude);
      


    if( navigator.geolocation ) {
       navigator.geolocation.getCurrentPosition( success);
    } else {
        console.log('Sorry, your browser does not support geolocation services');
        initMap();
    }

    function success(position)
    {
        document.getElementById('long').value = position.coords.longitude;
        document.getElementById('lat').value = position.coords.latitude;

        if(position.coords.longitude != "" && position.coords.latitude != ""){
            current_longitude = position.coords.longitude;
            current_latitude = position.coords.latitude;
          
        }
		
        initMap();
    }
</script> 
    
    <script type="text/javascript">	
        var date = new Date();
        date.setDate(date.getDate()-1);
        $('#datepicker').datepicker({  
            startDate: date
        });	

		
        $('#timepicker').timepicker({showMeridian : false});		
        function card(value){
            if(value == 'CARD'){
                $('#card_id').fadeIn(300);
            }else{
                $('#card_id').fadeOut(300);
            }
        }	
        
        $('#schedule_button').click(function(){
            alert("ride script");
            $("#datepicker").clone().attr('type','hidden').appendTo($('#create_ride'));
            $("#timepicker").clone().attr('type','hidden').appendTo($('#create_ride'));
            alert("ride script before submit");
            document.getElementById('create_ride').submit();
        }); 		

    </script>
    
<script type="text/javascript">

    function disableEnterKey(e)
    {
        var key;
        if(window.e)
            key = window.e.keyCode; // IE
        else
            key = e.which; // Firefox

        if(key == 13)
            return e.preventDefault();
    }
</script>

@endsection