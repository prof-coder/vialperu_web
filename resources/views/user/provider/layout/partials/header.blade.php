
<header>
    <?php
    // echo "<pre>";
    // print_r($_SERVER['REQUEST_URI']);
    // echo $fully . "Palak";
    // echo "</pre>";

    $fully_sum = 0; ?>
      @foreach($fully as $each)
        
        @if($each->payment != "")
            <?php $each_sum = 0;
            $each_sum = $each->payment->tax + $each->payment->fixed + $each->payment->distance + $each->payment->commision;
            $fully_sum += $each_sum;
            ?>
        @endif
              
      @endforeach
 <?php //echo currency($fully_sum) . "Palak2"; ?>
<div class="site-header">
    <nav class="navbar navbar-fixed-top">
      <div class="">
        <div class="col-md-12">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>             
              
              <a class="" href="{{url('/provider/login')}}"><img src="/img/instacab_logo.png" style="height:50px; "></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" style="display: inline-grid;">              
                  <li class="menu-drop">
                        
                      <div class="dropdown">
                         <form id="form_online" method="POST" action="{{url('/provider/profile/available')}}">
                             <label class="btn-primary" style="background: transparent;color: black;"> Total Revenue</label>
                             <label class="btn-primary" style="background: transparent;color: black;" id="set_fully_sum"> 00.00</label>

                              <input type="text" value="active" name="service_status" id="active_offline_hdn" readonly />
                             <input checked  name="CARD" id="stripe_check" type="checkbox" class="js-switch" data-color="#43b968">
                         </form>
                        
                    
                         
                         <!--input @if(Setting::get('CARD') == 1) checked  @endif  name="CARD" id="stripe_check" onchange="cardselect()" type="checkbox" class="js-switch" data-color="#43b968"-->

                         <!--button class="primary-btn fare-btn provider-button" type="submit" style=" background: #37b38b;"> Online</button>
                         <button class="primary-btn fare-btn provider-button" type="submit" style=" background: #FF0000;"> Offline</button-->

                          <!--button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{Auth::user()->first_name}} {{Auth::user()->last_name}}
                          <span class="caret"></span></button-->
                          <!--ul class="dropdown-menu">
                            <li><a href="{{url('trips')}}">@lang('user.my_trips')</a></li>
                            <li><a href="{{url('profile')}}">@lang('user.profile.profile')</a></li>
                            <li><a href="{{url('change/password')}}">@lang('user.profile.change_password')</a></li>
                            <li><a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">@lang('user.profile.logout')</a></li>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                          </ul-->
                        </div>
                  </li>
                </ul>
            </div>
        </div>
      </div>
    </nav>
  </div>  
</header>

@section('scripts')
<script type="text/javascript">
  //alert("hello");
  document.getElementById('set_fully_sum').textContent = "{{currency($fully_sum)}}";
</script>
@endsection
<!--header>
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/provider') }}"><img src="{{ Setting::get('site_logo', asset('logo-black.png')) }}"></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('help') }}">Help</a></li>
                    <li class="dropdown mega-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::guard('provider')->user()->first_name }} {{ Auth::guard('provider')->user()->last_name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu mega-dropdown-menu">
                            <li class="row no-margin">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                    <a href="#" class="new-pro-img bg-img" style="background-image: url({{ Auth::guard('provider')->user()->avatar ? asset('storage/'.Auth::guard('provider')->user()->avatar) : asset('asset/img/provider.jpg') }});">
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h6 class="new-pro-name">
                                        {{ Auth::guard('provider')->user()->first_name }} {{ Auth::guard('provider')->user()->last_name }}
                                    </h6>
                                    <div class="rating-outer new-pro-rating">
                                        <input type="hidden" class="rating"/ value="{{ Auth::guard('provider')->user()->rating }}" readonly>
                                    </div>

                                    <a href="{{ route('provider.profile.index') }}" class="new-pro-link">My Profile</a>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('provider.change.password')}}">Change Password</a></li>
                            <li>
                                <a href="{{ url('/provider/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/provider/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header-->