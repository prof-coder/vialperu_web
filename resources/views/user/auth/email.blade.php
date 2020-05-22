@extends('website.app')

@section('content')
<?php $login_user = asset('asset/img/login-user-bg.jpg'); ?>
<div class="container-fluid" style="margin-bottom: 50px;text-align:center;">
    <h4 style="margin-top: 40px;">Reset Password</h4><br>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <div class="col-md-12" style="margin-top: 10px;">
            <input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" style="width: 312px;margin-left: 525px;">
            <br/>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif                        

            <div class="facebook_btn">
                <button value="submit" class="btn btn-default btn-arrow-left" style="width: 312px;border-radius: 0px;background-color: #5dce5d">Next</button>
            </div>  
             <h5>Already have account?<a class="log-blk-btn" href="{{url('PassengerSignin')}}">Click Here</a></h5>
        </div>  
    
    </form>     
 </div>




@endsection
