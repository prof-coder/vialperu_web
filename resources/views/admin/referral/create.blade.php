@extends('admin.layout.base')

@section('title', 'Reward ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
            <!-- <a href="{{ route('admin.promocode.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a> -->

            <h5 style="margin-bottom: 2em;"><i class="ti-bookmark-alt"></i>&nbsp;Referral Rule Setting</h5><hr>

            <form class="form-horizontal" action="{{route('admin.referral.updated')}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="promo_code" class="col-xs-4 col-form-label">Referral Discount in percentage</label>
                    <div class="col-xs-8">
                        <input class="form-control" type="text" value="{{$referral_discount}}" name="referral_discount" required id="referral_discount" placeholder="Referral Discount">
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