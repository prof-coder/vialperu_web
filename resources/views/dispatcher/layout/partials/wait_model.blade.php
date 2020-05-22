<div class="modal" id="wait-modal" style="background-color: #99999952;">
	<div class="modal-dialog">
		<div class="modal-content">
		  <!-- Modal Header -->
		  <div class="modal-header">
				<h4 class="modal-title pull-left">Waitting For Driver Acceptance</h4>
				<span class="btn close wait_model_close pull-right" data-dismiss="modal" onclick="window.location.reload()"><i class="fa fa-times"></i></span>
		  </div>
		  <!-- Modal body -->
			<div class="modal-body">
				<section id="timer" style="height: 200px; width: 200px; overflow: hidden; margin: 20px auto;">
					<img src="{{ asset('asset/front/img/loading.gif') }}" style="width:100%; height: auto;"/>
				
					<!--div class="row">
						<div class="col-xs-12 col-sm-12 countdown-wrapper text-center mb20">
							<div class="alert alert-info dispatcherRequestNotFound" style="display: none;">
								  <strong>Info!</strong> <span id="dispatcherRequestNotFound"></span>
							</div>
							<div class="card-block">
								
							</div>
						</div> 
					</div-->
				</section>
				<!--section class="ride_fn_btn">
				   <div class="row">
						<!--div class="col-sm-6"> 
							 <button type="button" class="btn btn-primary btn-block" onClick="dispatcherRequest();">Try Again</button>
						</div >
						
						 <div class="col-sm-12"> 
							 <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" onClick="manualRequest();">Book Manually</button>
						</div>										
					</div>
				</section>
			  <!-- Modal footer $('#foo').trigger('click'); -->
				  <div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>
