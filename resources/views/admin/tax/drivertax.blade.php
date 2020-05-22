@extends('admin.layout.base')

@section('title', 'tax')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            	<h3><i class="ti-infinite"></i>&nbsp;Driver Tax Details</h3><hr>
                <hr/>

            	<div class="row">
                    <div class="col-lg-4 col-md-6 col-xs-12">
						<div class="box box-block bg-danger mb-2 shadow-box">
							<div class="t-content">
								<h6 class="text-uppercase mb-1">Total Amount</h6>
								<h1 class="mb-1">
									{{$company_data->total}}
								</h1>
							
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 col-xs-12">
						<div class="box box-block bg-success mb-2 shadow-box">
							
							<div class="t-content">
								<h6 class="text-uppercase mb-1">Total Commission</h6>
								<h1 class="mb-1">{{$company_data->commission}}</h1>
							
							</div>
						</div>
					</div>
	            	<div class="col-lg-4 col-md-6 col-xs-12">
						<div class="box box-block bg-danger mb-2 shadow-box">
				
							<div class="t-content">
								<h6 class="text-uppercase mb-1">Total Tax</h6>
								<h1 class="mb-1">{{$total_tax}}</h1>
							
							</div>
						</div>
					</div>

				

				

						<div class="row row-md mb-2" style="padding: 15px;">
							<div class="col-md-12">
									<div class="">
										<div class="box-block clearfix">
											<div class="float-xs-right">
											</div>
										</div>
										@if(count($requests) != 0)
								            <table class="table table-striped table-bordered dataTable" id="table-2" style="width:100%;">
								                <thead>
								                   <tr>
														<td>ID</td>
														<td>Booking Id</td>
														<td>Total Amount</td>
														<td>Commission</td>
														<td>Tax</td>

													</tr>
								                </thead>
								                <tbody>
								                
														@foreach($requests as $index => $request)
															<tr>
																<td>{{$request->id}}</td>
																<td>{{$request->booking_id}}</td>
																<td>{{$request->payment->total}}</td>
																<td>{{$request->payment->commision}}</td>
																<td>{{($request->payment->commision * $tax_percentage)/100}}</td>
															</tr>
														@endforeach
															
								                <tfoot>
								                    <tr>
														
													</tr>
								                </tfoot>
								            </table>
								            @else
								            <h6 class="no-result">No results found</h6>
								            @endif 

									</div>
								</div>

							</div>

            	</div>

            </div>
        </div>
    </div>

@endsection
