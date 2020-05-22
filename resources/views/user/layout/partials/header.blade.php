<!-- Header -->

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

               <a class="navbar-brand" href="{{url('dashboard')}}" style="background:white;">

                  <div class="logo">

                     <img  style="width: 132px;height: 40px; margin-left: -85px;" src=" {{ url(Setting::get('site_logo', asset('logo-black.png'))) }}">

                  </div>

               </a>

            </div>

         </div>

         <div class="col-sm-9 col-xs-9">

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

               <ul class="nav navbar-nav navbar-right">

                  <li class="menu-drop">

                     <div class="dropdown">

                        <p class="btn btn-primary" style="padding-top: 24px;"> My Wallet {{currency(Auth::user()->wallet_balance)}}</p>

                     </div>

                  </li>
                  
               </ul>

            </div>

         </div>

      </div>

   </nav>

</div>