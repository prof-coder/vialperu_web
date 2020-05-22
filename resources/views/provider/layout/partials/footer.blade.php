<div class="footer row no-margin">
    <div class="container">
        <div class="row no-margin">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <ul>
                    <li><a href="#">Ride</a></li>
                    <li><a href="#">Drive</a></li>
                    <li><a href="#">Cities</a></li>
                    <li><a href="#">Fare Estimate</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <ul>
                    <li><a href="#">Signup to Ride</a></li>
                    <li><a href="#">Become a Driver</a></li>
                    <li><a href="#">Ride Now</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
                <h5>Get App on</h5>
                <ul class="app">
                    <li><a href="{{Setting::get('store_link_ios','#')}}"><img src="{{ asset('asset/img/appstore.png') }}"></a></li>
                    <li><a href="{{Setting::get('store_link_android','#')}}"><img src="{{ asset('asset/img/playstore.png') }}"></a></li>
                </ul>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
                <h5>Connect us</h5>
                <ul class="social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="row no-margin">
            <div class="col-md-12 copy">
                <p>{{ Setting::get('site_copyright', '&copy; '.date('Y').' Appoets') }}</p>
            </div>
        </div>
    </div>
</div>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d9d7783db28311764d7fa68/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->