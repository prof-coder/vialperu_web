@extends('admin.layout.base')

@section('title', 'Reward ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
            <!-- <a href="{{ route('admin.promocode.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a> -->

            <h5 style="margin-bottom: 2em;"><i class="ti-bookmark-alt"></i>&nbsp;Reward Rule Setting</h5><hr>

            <form class="form-horizontal" action="{{route('admin.reward.updated')}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="promo_code" class="col-xs-4 col-form-label">Minimum Point for Redeem</label>
                    <div class="col-xs-8">
                        <input class="form-control" type="text" value="{{$min_redeem_ammount}}" name="min_redeem_ammount" required id="min_redeem_ammount" placeholder="Minimum Point for Redeem">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="promo_code" class="col-xs-4 col-form-label">Reward Point in (%)</label>
                    <div class="col-xs-8">
                        <input class="form-control" type="text" value="{{$reward_point}}" name="reward_point" required id="reward_point" placeholder="Reward Point">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="promo_code" class="col-xs-4 col-form-label">Redeem Amount For 1 Point ({{$currency}})</label>
                    <div class="col-xs-8">
                        <input class="form-control" type="text" value="{{$redeem_amount}}" name="redeem_amount" required id="redeem_amount" placeholder="Redeem Amount">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="zipcode" class="col-xs-4 col-form-label"></label>
                    <div class="col-xs-8">
                        <button type="submit" class="btn btn-success shadow-box">Update</button>
                    </div>
                </div>
            </form>
        </div>

            
            
        </div>
    </div>
@endsection