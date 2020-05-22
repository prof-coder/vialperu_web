<!-- Header -->
<?php if(@activeOffline()->status=='offline'){
  $status = @activeOffline()->status;
  $check = '';
}else{ $status = 'active';
       $check = 'checked="checked"';} ?>
<div class="site-header">
  <nav class="navbar navbar-light">
    <div class="container-fluid">
      <div class="col-sm-1 col-xs-1">
        <div class="hamburger hamburger--3dy-r">
           <div class="hamburger-box">
            <div class="hamburger-inner"></div>
           </div>
        </div>
      </div>
      <div class="col-sm-2 col-xs-2">
        <div class="navbar-left" style="background-color: #fff;">
          <a class="navbar-brand" href="{{url('provider')}}" style="background:white;">
          <div class="logo">
            <img  style="width: 132px;height: 40px; margin-left: -85px;" src=" {{ url(Setting::get('site_logo', asset('logo-black.png'))) }}">
          </div>
          </a>
        </div>
      </div>
      <div class="col-sm-9 col-xs-9">
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">            
             <ul class="nav navbar-nav navbar-right">                  
               <li class="menu-drop" style="margin-top: 10px;">
                 <div class="dropdown">
                    <form id="form_online" method="POST" action="{{url('/provider/profile/available')}}">
                             <label class="btn-primary" style="background: transparent;color: black;"> Total Revenue</label>
                             <label class="btn-primary" style="background: transparent;color: black;" id="set_fully_sum"> 00.00</label>
                            <input type="text" value="{{@$status}}" name="service_status" id="active_offline_hdn" readonly />
                            <label class="switch" id="stripe_check">
                            <input type="checkbox" name="CARD" {{$check}}>
                            <span class="slider round"></span>
                          </label>                             
                    </form>
              </div>
          </li>
        </ul>
        </div>
      </div>
    </div>
  </nav>
</div>