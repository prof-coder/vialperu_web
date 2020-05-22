@extends('provider.layout.app')
@section('content')
 <div class="col-md-12" style="margin-bottom: 20px">
    <div class="dash-content">
        <!-- End of earning head -->
        <div>
            <!-- Earning Content -->
            <div class="earning-content">
                <div class="container-fluid">

                    <!-- Earning section -->
                    <div class="earning-section earn-main-sec pad20">
                        <!-- Earning section head -->
                        <div class="earning-section-head row no-margin">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-left-padding">
                                <h4 class="earning-section-tit">My Ride</h4>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="daily-earn-right text-right">
                                    <div class="status-block display-inline row no-margin">
                                        <form class="form-inline status-form">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select type="password" class="form-control mx-sm-3" style="height: auto;">
                                                    <option>All Rides</option>
                                                    <option>Completed</option>
                                                    <option>Pending</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- View tab -->

                                    <!-- End of view tab -->
                                </div>
                            </div>
                        </div>
                        <!-- End of earning section head -->

                        <!-- Earning-section content -->
                        <div class="row no-margin ride-detail">
                            <div class="col-md-12">

                                <table class="table table-condensed" style="border-collapse:collapse;">
                                    <thead>
                                        <tr>
                                            <th>Pickup Time</th>
                                            <th>Booking Id</th>
                                            <th>Vehicle</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Distance</th>
                                            <th>Cash</th>
                                            <th>Total Earnings</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    @foreach($fully as $each)
                                    <?php @$fully_sum  = 0; $each_sum = 0; ?>
                                        <tr>
                                            <td>{{date('Y D, M d - H:i A',strtotime($each->created_at))}}</td>
                                            <td>{{ $each->booking_id }}</td>
                                            <td>
                                            	@if($each->service_type)
                                            		{{$each->service_type->name}}
                                            	@endif
                                            </td>
                                            <td>
                                            	@if($each->finished_at != null && $each->started_at != null) 
                                                    <?php 
                                                    $StartTime = \Carbon\Carbon::parse($each->started_at);
                                                    $EndTime = \Carbon\Carbon::parse($each->finished_at);
                                                    echo $StartTime->diffInHours($EndTime). " Hours";
                                                    echo " ".$StartTime->diffInMinutes($EndTime). " Minutes";
                                                    ?>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{$each->status}}</td>
                                            <td>{{round($each->distance,2)}} Kms</td>
                                            <td>
                                            	@if($each->payment != "")
                                            		<?php 
                                            		$each_sum = $each->payment->tax + $each->payment->fixed + $each->payment->distance + $each->payment->commision-$each->payment->discount;
                                            		@$fully_sum = $each_sum-$each->payment->commision;
                                            		?>
                                            	@endif
                                            	{{currency($each_sum)}}
                                            </td>
                                            <td>{{currency(@$fully_sum)}}</td>
                                            <td>
                                                <form action="{{url('provider/mytrips/detail')}}">
                                                    <input type="hidden" value="{{$each->id}}" name="request_id">
                                                    <button type="submit" style="margin-top: 0px;" class="btn-black btn-rounded fare-btn detail_button">Detail</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    <!-- End of earning section -->
                    </div>
                </div>
            <!-- Endd of earning content -->
            </div> 
        </div>            
    </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.detail_button').click(function(){
         $(this).parent().submit();
    });
	document.getElementById('set_fully_sum').textContent = "{{currency(@$fully_sum)}}";
</script>
@endsection