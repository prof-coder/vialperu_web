@extends('provider.layout.app')

@section('content')


    <div class="col-md-12" style="margin-bottom: 20px">
    <div class="dash-content">
        <div class="row no-margin">
            <div class="col-md-12">
                <h4 class="page-title">Update Profile</h4>
            </div>
        </div>
            <!-- Pro-dashboard-content -->
            <div class="pro-dashboard-content">
                <div class="profile">
                    <!-- Profile head -->
                    
                    <div class="container-fluid">
                        <div class="profile-head white-bg row no-margin">
                            <div class="prof-head-left col-lg-2 col-md-12 col-sm-3 col-xs-12" style="margin-top: -20px;">
                                <div class="profile-img-blk">
                                    <div class="img_outer">
                                        <img class="profile_preview" id="profile_image_preview" src="{{ Auth::guard('provider')->user()->avatar ? asset('storage/app/public/'.Auth::guard('provider')->user()->avatar) : asset('asset/front/img/provider.jpg') }}" alt="your image"/>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-12">
                                <h3 style="font-weight: bold;">{{ @Auth::guard('provider')->user()->first_name }}</h3>
                                <p style="margin-left: 27px;font-weight: bold;">{{ (@Auth::guard('provider')->user()->status == 'banned') ? 'Not Approved' : 'Approved' }}</p>
                            </div>
                        </div>
                    </div>

                      <!-- Profile-content -->
                    <div class="profile-content">
                        <div class="container">
                            <div class="row no-margin">
                                <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 no-padding">
                                    <form class="profile-form" action="{{route('provider.profile.update')}}" method="POST" enctype="multipart/form-data" role="form">
                                        {{csrf_field()}}
                                        <!-- Prof-form-sub-sec -->
                                        <div class="prof-form-sub-sec">
                                            <div class="row no-margin">
                                                <div class="prof-sub-col col-xs-12 no-left-padding">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" style="width: 663px;" placeholder="Name" name="first_name" value="{{ Auth::guard('provider')->user()->first_name }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="prof-sub-col prof-1 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Avatar</label>
                                                        <input type="file" class="form-control" name="avatar">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row no-margin">
                                                <div class="prof-sub-col col-sm-6 col-xs-12 no-left-padding">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" required placeholder="Contact Number" name="mobile" value="{{ Auth::guard('provider')->user()->mobile }}">
                                                    </div>
                                                </div>
                                                <div class="prof-sub-col col-sm-6 col-xs-12 no-right-padding">
                                                    <div class="form-group no-margin">
                                                        <label for="exampleSelect1">Language</label>
                                                        <select class="form-control" name="language" style="height: 44px;">
                                                            <option value="English">English</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of prof-sub-sec -->

                                        <!-- Prof-form-sub-sec -->
                                        <div class="prof-form-sub-sec border-top">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{ Auth::guard('provider')->user()->profile ? Auth::guard('provider')->user()->profile->address : "" }}">
                                                <input type="text" class="form-control" placeholder="Enter Suite, Floor, Apt (optional)" style="border-top: none;" name="address_secondary" value="{{ Auth::guard('provider')->user()->profile ? Auth::guard('provider')->user()->profile->address_secondary : "" }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea class="form-control"  name="description"  placeholder="Enter your story" style="width:100%; height:100px;">{{ @Auth::guard('provider')->user()->profile ? @trim(Auth::guard('provider')->user()->profile->description) : "" }}</textarea>
                                            </div>

                                            <div class="row no-margin">
                                                <div class="prof-sub-col col-sm-6 col-xs-12 no-left-padding">
                                                    <div class="form-group no-margin">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{ Auth::guard('provider')->user()->profile ? Auth::guard('provider')->user()->profile->city : "" }}">
                                                    </div>
                                                </div>
                                                <div class="prof-sub-col col-sm-6 col-xs-12 no-right-padding">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select class="form-control" name="country" style="height: 44px;>
                                                            <option value="US">United States</option>
                                                            <option value="IN">India</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of prof-sub-sec -->

                                        <div class="row no-margin">
                                            <div class="prof-sub-col col-sm-6 col-xs-12 no-left-padding">
                                                <div class="form-group no-margin">
                                                    <label>Postal Code</label>
                                                    <input type="text" class="form-control" placeholder="Postal Code" name="postal_code" value="{{ Auth::guard('provider')->user()->profile ? Auth::guard('provider')->user()->profile->postal_code : "" }}">
                                                </div>
                                            </div>
                                            <div class="prof-sub-col col-sm-6 col-xs-12 no-right-padding">
                                                <div class="form-group">
                                                    <label>Vehicle</label>
                                                    <select class="form-control" name="service_type" style="height: 44px;>
                                                        <option value="">Select Service</option>
                                                        @foreach(get_all_service_types() as $type)
                                                            <option @if(@Auth::guard('provider')->user()->service->service_type->id == $type->id) selected="selected" @endif value="{{$type->id}}">{{$type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row no-margin">
                                            <div class="prof-sub-col col-sm-6 col-xs-12 no-left-padding">
                                                <div class="form-group no-margin">
                                                    <label>Plate No</label>
                                                    <input type="text" class="form-control" placeholder="Driving License No" name="service_number" value="{{ @Auth::guard('provider')->user()->service->service_number ? @Auth::guard('provider')->user()->service->service_number : "" }}">
                                                </div>
                                            </div>
                                            <div class="prof-sub-col col-sm-6 col-xs-12 no-right-padding">
                                                <div class="form-group">
                                                    <label>Vehicle Model</label>
                                                    <input type="text"  placeholder="Police Verification No" class="form-control" name="service_model" value="{{ @Auth::guard('provider')->user()->service->service_model ? @Auth::guard('provider')->user()->service->service_model : "" }}">
                                                </div>
                                            </div>
                                        </div>

                                         <!-- Prof-form-sub-sec -->
                                        <div class="prof-form-sub-sec">
                                            <div class="col-xs-12 col-md-6">
                                                <button type="submit" class="btn btn-block btn-success shadow-box" style="margin-left: -15px;">Update</button>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <a href="{{url('provider/profile')}}" class="btn btn-block btn-danger shadow-box" style="margin-left: -15px;">Cancel</a>
                                            </div>
                                        </div>
                                        <!-- End of prof-sub-sec -->
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>            
@endsection