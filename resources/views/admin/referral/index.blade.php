@extends('admin.layout.base')

@section('title', 'Reward ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5 class="mb-1"><i class="ti-bookmark-alt"></i>&nbsp;Referal History</h5><hr>
                <table class="table table-striped table-bordered dataTable" id="table-2" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name </th>
                            <th>Ride Details </th>
                            <th>Date & Time </th>
                            <th>Discount (%)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($referral_history as $index => $referral)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$referral->user['first_name']}}</td>
                            <td>
                               @if($referral->user_request['status'] != "CANCELLED")
                               <a class="text-primary" href="{{route('admin.requests.show',$referral->trip_id)}}"><span class="underline">Ride Details</span></a>
                               @else
                               <span>No Details Found </span>
                               @endif                 
                            </td>
                            <td>
                               <span class="text-muted">{{$referral->created_at->diffForHumans()}}</span>
                            </td>
                            <td>
                                {{$referral->referral_discount}}
                            </td>
                            <td>
                            <a href="{{ route('admin.requests.show', $referral->trip_id) }}" class="btn shadow-box btn-black"><i class="fa fa-eye"></i></a>
                            </td>
                           
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection