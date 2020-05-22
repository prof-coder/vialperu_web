<!-- Header -->
<div class="site-header navbar-fixed-top">
	<nav class="navbar navbar-light">
		 <div class="col-sm-1 col-xs-1">
            <div class="hamburger hamburger--3dy-r">
               <div class="hamburger-box">
                  <div class="hamburger-inner"></div>
               </div>
            </div>
         </div>
         <div class="col-sm-2 col-xs-2">
            <div class="navbar-left" style="background-color: #fff;">
               <a class="navbar-brand" href="{{url('cms/dashboard')}}" style="background:white;">
                  <div class="logo">
                     <img  style="width: 132px;height: 40px;" src=" {{ url(Setting::get('site_logo', asset('logo-black.png'))) }}">
                  </div>
               </a>
               <div class="toggle-button-second dark float-xs-right hidden-md-up">
                  <i class="ti-arrow-left"></i>
               </div>
               <div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
                  <span class="more"></span>
               </div>
            </div>
         </div>
		<div class="col-sm-9 col-xs-9">
            <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
               <ul class="nav navbar-nav float-md-right">
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                     <i class="ti-flag-alt"></i>
                     <span class="hidden-md-up ml-1">Tasks</span>
                     <span class="tag tag-success top">3</span>
                     </a>
                     <div class="dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp">
                        <div class="t-item">
                           <div class="mb-0-5">
                              <a class="text-black" href="#">First Task</a>
                              <span class="float-xs-right text-muted">75%</span>
                           </div>
                           <progress class="progress progress-danger progress-sm" value="75" max="100">100%</progress>
                           <span class="avatar box-32">
                           </span>
                           <a class="text-black" href="#">John Doe</a>, <span class="text-muted">5 min ago</span>
                        </div>
                        <div class="t-item">
                           <div class="mb-0-5">
                              <a class="text-black" href="#">Second Task</a>
                              <span class="float-xs-right text-muted">40%</span>
                           </div>
                           <progress class="progress progress-purple progress-sm" value="40" max="100">100%</progress>
                           <span class="avatar box-32">
                           </span>
                           <a class="text-black" href="#">John Doe</a>, <span class="text-muted">15:07</span>
                        </div>
                        <div class="t-item">
                           <div class="mb-0-5">
                              <a class="text-black" href="#">Third Task</a>
                              <span class="float-xs-right text-muted">100%</span>
                           </div>
                           <progress class="progress progress-warning progress-sm" value="100" max="100">100%</progress>
                           <span class="avatar box-32">
                           </span>
                           <a class="text-black" href="#">John Doe</a>, <span class="text-muted">yesterday</span>
                        </div>
                        <div class="t-item">
                           <div class="mb-0-5">
                              <a class="text-black" href="#">Fourth Task</a>
                              <span class="float-xs-right text-muted">60%</span>
                           </div>
                           <progress class="progress progress-success progress-sm" value="60" max="100">100%</progress>
                           <span class="avatar box-32">
                           </span>
                           <a class="text-black" href="#">John Doe</a>, <span class="text-muted">3 days ago</span>
                        </div>
                        <a class="dropdown-more" href="#">
                        <strong>View all tasks</strong>
                        </a>
                     </div>
                  </li> -->
                  <!-- <li class="nav-item dropdown">
                     <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
                     <i class="ti-email"></i>
                     <span class="hidden-md-up ml-1">Notifications</span>
                     <span class="tag tag-danger top">12</span>
                     </a>
                     <div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated fadeInUp">
                        <div class="m-item">
                           <div class="mi-icon bg-info"><i class="ti-comment"></i></div>
                           <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">commented post</span> <a class="text-black" href="#">Lorem ipsum dolor</a></div>
                           <div class="mi-time">5 min ago</div>
                        </div>
                        <div class="m-item">
                           <div class="mi-icon bg-danger"><i class="ti-heart"></i></div>
                           <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">liked post</span> <a class="text-black" href="#">Lorem ipsum dolor</a></div>
                           <div class="mi-time">15:07</div>
                        </div>
                        <div class="m-item">
                           <div class="mi-icon bg-purple"><i class="ti-user"></i></div>
                           <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">followed</span> <a class="text-black" href="#">Kate Doe</a></div>
                           <div class="mi-time">yesterday</div>
                        </div>
                        <div class="m-item">
                           <div class="mi-icon bg-danger"><i class="ti-heart"></i></div>
                           <div class="mi-text"><a class="text-black" href="#">John Doe</a> <span class="text-muted">liked post</span> <a class="text-black" href="#">Lorem ipsum dolor</a></div>
                           <div class="mi-time">3 days ago</div>
                        </div>
                        <a class="dropdown-more" href="#">
                        <strong>View all notifications</strong>
                        </a>
                     </div>
                  </li> -->
                  
                  <li class="nav-item dropdown hidden-sm-down">
                     <a href="#" data-toggle="dropdown" aria-expanded="false">
                     <span class="avatar box-32">
                     
                      @if(isset(Auth::guard('admin')->user()->picture))
                     <img src="{{img(Auth::guard('cms')->user()->picture)}}" alt="">
                     @else
                      <img src="{{asset('asset/admin/avatar.jpg')}}" alt="">
                     @endif
                     </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right animated fadeInUp">
                         <a class="dropdown-item" href="{{route('cms.profile')}}">
                        <i class="ti-settings mr-0-5"></i> Profile
                        </a>
                        <a class="dropdown-item" href="{{route('cms.password')}}">
                        <i class="ti-settings mr-0-5"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ url('/cms/logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="ti-power-off mr-0-5"></i> Sign out</a>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
	</nav>
</div>