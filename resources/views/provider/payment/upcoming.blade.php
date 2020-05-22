@extends('provider.layout.app')

@section('content')

 <div class="col-md-12" style="margin-bottom: 20px;">
    <div class="">
        <div class="row no-margin">
        <div class="pro-dashboard-head">
        <!--div class="container-fluid">
            <a href="{{url('provider/earnings')}}" class="pro-head-link">Payment Statements</a>
             <a href="{{url('provider/upcoming')}}" class="pro-head-link active">Upcoming</a>
  
        </div-->
        </div>

        <div class="pro-dashboard-content">
            
            <!-- Earning Content -->
            <div class="earning-content gray-bg">
                <div class="container-fluid">


                    <!-- Earning section -->
                    <div class="earning-section earn-main-sec pad20">
                        <!-- Earning section head -->
                        <div class="earning-section-head row no-margin">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-left-padding">
                                <h3 class="earning-section-tit">Schedule Rides</h3>
                            </div>
                        </div>
                        <!-- End of earning section head -->

                        <!-- Earning-section content -->
                        <div class="tab-content list-content">
                            <div class="list-view pad30 ">
                                
                                 <table class="table table-condensed" style="border-collapse:collapse;">
                                    <thead>
                                        <tr>
                                            <!--th>&nbsp;</th-->
                                            <th>Pickup Time</th>
                                            <th>Driver Type</th>
                                            <th>Pickup Address</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $fully_sum = 0;?>
                                    @if( count( $fully ) > 0 )
                                        @foreach($fully as $each)
                                            <tr data-toggle="collapse" data-target="" class="accordion-toggle collapsed">
                                                <!--td><span class="arrow-icon fa fa-chevron-right"></span></td-->
                                                <td>{{date('Y D, M d - H:i A',strtotime($each->schedule_at))}}</td>
                                                <td>
                                                    @if($each->service_type)
                                                        {{$each->service_type->name}}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$each->s_address}}
                                                </td>
                                                
                                                <td>{{$each->status}}</td>
                                                <td>
                                                    <form action="{{url('provider/upcoming/detail')}}">
                                                        <input type="hidden" value="{{$each->id}}" name="request_id">
                                                        <button type="submit" style="margin-top: 0px;" class="full-primary-btn fare-btn detail_button">Detail</button>
                                                    </form>
                                                    <!--a href="{{route('provider.cancel')}}?id={{$each->id}}" style="margin-top: 0px;" class="full-primary-btn fare-btn">Cancel</a-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td colspan="5" class="text-center" >No Ride Found</td>
                                        </tr>
                                    @endif

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
@endsection

@section('scripts')
<script type="text/javascript">
    $('.detail_button').click(function(){
         $(this).parent().submit();
    });
	document.getElementById('set_fully_sum').textContent = "{{currency($fully_sum)}}";
</script>
@endsection