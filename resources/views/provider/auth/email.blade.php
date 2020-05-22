@extends('website.app')

@section('content')
<?php $login_user = asset('asset/img/login-user-bg.jpg'); ?>
<div class="container-fluid" style="margin-bottom: 50px;">
<!--     <div class="col-md-8" > -->

        <h4 style="margin-top: 40px;">Reset Password</h4>
    <!-- </div> -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form role="form" method="POST" action="{{ url('/provider/password/email') }}">
        {{ csrf_field() }}

        <div class="col-md-12" style="margin-top: 10px;">
            <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" style="width: 312px;">
            <br/>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif                        
        

            <div class="facebook_btn">
                <button value="submit" class="btn btn-default btn-arrow-left" style="width: 312px;border-radius: 0px;background-color: #5dce5d">Next</button>
            </div>  
             <h5>Already have account?<a class="log-blk-btn" href="{{url('/provider/login')}}">Click Here</a></h5>
        </div>  
    
    </form>     
 </div>




@endsection
