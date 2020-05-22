@extends('admin.layout.base')

@section('title', 'Promocode User ')

@section('content')
    <style>.dataTables_empty{display:none}</style>
    <div class="content-area py-1" id="promocode">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
                <h5 class="mb-1"><i class="ti-bookmark-alt"></i>&nbsp;Promocode User</h5><hr>
                <div class="row" style="display:block">
                    <div class="col-sm-4">
                    	<div class="form-group">
    						<select class='form-control' v-model='code' @change='getPromocodesUser()' name="promocode" id="promocode">
    							<option value='0' >Select Promo Code</option>
    							<option v-for='data in codes' :value='data.id'>@{{ data.promo_code }}</option>
    						</select>
    					</div>
    				</div>
				</div>
				 <div class="clearfix"></div>
                <!--<a href="{{ route('admin.promocode.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Promocode</a>-->

                <table class="table table-striped table-bordered dataTable" id="table-2" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Promocode</th>
                            <th>User</th>
                            <th>Status</th>
                             <th>Discount</th>
                            <!--<th>Applied Date</th>-->
                            <th>Expiration Date</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    <!--@foreach($promocodes as $index => $promo)-->
                    <!--    <tr>-->
                    <!--        <td>{{$index + 1}}</td>-->
                    <!--        <td>{{$promo->promo_code}}</td>-->
                    <!--        <td>{{$promo->discount}}</td>-->
                    <!--        <td>-->
                    <!--            {{date('d-m-Y',strtotime($promo->expiration))}}-->
                    <!--        </td>-->
                    <!--        <td>-->
                    <!--            @if(date("Y-m-d") <= $promo->expiration)-->
                    <!--                <span class="tag tag-success">Valid</span>-->
                    <!--            @else-->
                    <!--                <span class="tag tag-danger">Expiration</span>-->
                    <!--            @endif-->
                    <!--        </td>-->
                    <!--        <td>-->
                    <!--            {{promo_used_count($promo->id)}}-->
                    <!--        </td>-->
                    <!--        <td>-->
                    <!--            <form action="{{ route('admin.promocode.destroy', $promo->id) }}" method="POST">-->
                    <!--                {{ csrf_field() }}-->
                    <!--                <input type="hidden" name="_method" value="DELETE">-->
                    <!--                <a href="{{ route('admin.promocode.edit', $promo->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>-->
                    <!--                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>-->
                    <!--            </form>-->
                    <!--        </td>-->
                    <!--    </tr>-->
                    <!--@endforeach-->
                    <tr v-for="(usecode,index) in codesuser">
                       <td>@{{index + 1}}</td>
                       <td>@{{usecode.promocode.promo_code}}</td>
                       <td>@{{usecode.promouser.first_name}}</td>
                       <td>@{{usecode.status}}</td>
                       <td>@{{usecode.promocode.discount}}</td>
                       <!--<td>@{{usecode.created_at}}</td>-->
                       <td>@{{formattedDate(usecode.promocode.expiration)}}</td>
                      
                    </tr>
                    </tbody>
                    <tfoot>
                     
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection