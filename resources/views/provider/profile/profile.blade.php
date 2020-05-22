@extends('provider.layout.app')

@section('content')

<div class="col-md-12" style="margin-bottom: 20px;">
    <div class="dash-content">
        <div class="row no-margin">
            <div class="col-md-12">
                <h4 class="page-title">Profile</h4>
                <h4><a href="{{url('provider/edit/profile')}}" style="float: right;margin-top: -34px;">@lang('user.profile.edit')</a></h4>
            </div>
        </div>
            @include('common.notify')

        <div class="container-fluid">
            <div class="profile-head white-bg row no-margin">
                <div class="prof-head-left col-lg-2 col-md-2 col-sm-3 col-xs-12" style="margin-top: -20px;">
                    <div class="profile-img-blk">
                        <div class="img_outer">
                            <img class="profile_preview" id="profile_image_preview" src="{{ Auth::guard('provider')->user()->avatar ? asset('storage/app/public/'.Auth::guard('provider')->user()->avatar) : asset('asset/front/img/provider.jpg') }}" alt="your image"/>
                        </div>
                    </div>
                    <div class=" {{ ( $status == 1) ? 'pr_success' : 'pr_fail'  }}">
                        <span style="margin-left: 27px;font-weight: bold;">{{  ($status == 1) ? 'Approved' : 'Not Approved' }}</span>
                    </div>  
                </div>
            </div>
        </div>

        <div class="row no-margin">
            <form>
                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Name</strong>: {{ @Auth::guard('provider')->user()->first_name }}</h5>
                </div>
                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Phone</strong>: {{ @Auth::guard('provider')->user()->mobile }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Language</strong>: {{ @Auth::guard('provider')->user()->profile ? @Auth::guard('provider')->user()->profile->language : "" }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Address</strong>: {{ @Auth::guard('provider')->user()->profile ? @Auth::guard('provider')->user()->profile->address : "" }}</h5>
                    <p class="col-md-6 no-padding">{{ @Auth::guard('provider')->user()->profile ? @Auth::guard('provider')->user()->profile->address_secondary : "" }}</p>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>City</strong>: {{ @Auth::guard('provider')->user()->profile ? @Auth::guard('provider')->user()->profile->city : "" }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Country</strong>: {{ @Auth::guard('provider')->user()->profile ? @Auth::guard('provider')->user()->profile->country : "" }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Postal Code</strong>: {{ @Auth::guard('provider')->user()->profile ? @Auth::guard('provider')->user()->profile->postal_code : "" }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Vehicle</strong>: {{ @Auth::guard('provider')->user()->service->service_type->name }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Plate No</strong>: {{ @Auth::guard('provider')->user()->service->service_number ? @Auth::guard('provider')->user()->service->service_number : "" }}</h5>
                </div>

                <div class="col-md-12 pro-form">
                    <h5 class="col-md-6 no-padding"><strong>Vehicle Model</strong>: {{ @Auth::guard('provider')->user()->service->service_model ? @Auth::guard('provider')->user()->service->service_model : "" }}</h5>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection