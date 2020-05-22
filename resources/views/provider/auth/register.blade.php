@extends('website.app')
@section('content')
<div class="signin_page">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
                  <h4>{{ trans('passengersignin.sign_up') }}</h4>

            <form role="form" method="POST" action= "{{ url('/provider/register') }}">
               {{ csrf_field() }}  
               <label>{{ trans('passengersignin.name') }}</label>
                    <input id="name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="{{ trans('passengersignin.name') }}" autofocus>

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif            


                <!--  <label>Last Name</label>
                <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">

                @if ($errors->has('last_name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('last_name') }}</strong>
                  </span>
              @endif -->

              <label>{{ trans('passengersignin.phone') }}</label>
              
              <input type="text" autofocus id="phone_number" class="form-control" placeholder="{{ trans('passengersignin.phone') }}" name="phone_number" value="{{ old('phone_number') }}" />
              
              @if ($errors->has('phone_number'))
                  <span class="help-block">
                      <strong>{{ $errors->first('phone_number') }}</strong>
                  </span>
              @endif

              <label>{{ trans('passengersignin.email_addr') }}</label>
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('passengersignin.email_addr') }}">

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif

              <label>{{ trans('passengersignin.password') }}</label>
              <input id="password" type="password" class="form-control" name="password" placeholder="{{ trans('passengersignin.password') }}">

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif

              <label>{{ trans('passengersignin.confirm_pass') }}</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('passengersignin.confirm_pass') }}">

              @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                  </span>
              @endif

              <label>{{ trans('passengersignin.select_vehicle') }}</label>
              <select class="form-control" name="vehicle_type" id="vehicle_type">
                <option value="">{{ trans('passengersignin.select_vehicle') }}</option>
                @foreach(get_all_service_types() as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
              </select>

              @if ($errors->has('vehicle_type'))
                  <span class="help-block">
                      <strong>{{ $errors->first('vehicle_type') }}</strong>
                  </span>
              @endif

              <label>{{ trans('passengersignin.vehicle_number') }}</label>
              <input id="service-number" type="text" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="{{ trans('passengersignin.vehicle_number') }}">

              @if ($errors->has('vehicle_number'))
                  <span class="help-block">
                      <strong>{{ $errors->first('vehicle_number') }}</strong>
                  </span>
              @endif

              <label>{{ trans('passengersignin.vehicle_model') }}</label>
              <input id="service-model" type="text" class="form-control" name="service_model" value="{{ old('service_model') }}" placeholder="{{ trans('passengersignin.vehicle_model') }}">

              @if ($errors->has('service_model'))
                  <span class="help-block">
                      <strong>{{ $errors->first('service_model') }}</strong>
                  </span>
              @endif

               <div class="facebook_btn">
                     <button value="submit" class="btn btn-default btn-arrow-left">{{ trans('passengersignin.next') }} </button>
                     <figure><img src="{{ url('asset/front_dashboard/img/btn_arrow.png') }}" alt="img"/></figure>
               </div>
         <h5>{{ trans('passengersignin.already_reg') }}<a class="log-blk-btn" href="{{ url('/provider/login') }}"> {{ trans('passengersignin.click_here') }}</a></h5>
               <!--<p class="helper"><a href="{{ url('/password/reset') }}">Forgot Your Password?</a></p>-->
                 @if(Setting::get('social_login', 0) == 1)
                    
                    <!--<div class="">
                        <a href="{{ url('/auth/facebook') }}"><button type="submit" class="btn btn-default" style="background-color:#3b61ad;">LOGIN WITH FACEBOOK</button></a>
                    </div>  
                    <div class="">
                        <a href="{{ url('/auth/google') }}"><button type="submit" class="btn btn-default" style="background-color:#f37151">LOGIN WITH GOOGLE+</button></a>
                    </div>-->
                @endif
         </div>

         </form>
    
     
        <div class="col-md-8" style="margin-top:77px;">
            <img src="{{ url('asset/front_dashboard/img/User-Signup.png') }}" alt="User Login" style="margin-top:-47px;width:100%;"> 
         </div>
     

      </div>
   </div>
</div>
@endsection