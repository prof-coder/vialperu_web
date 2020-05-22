<!--
====================================================================
Modificación: inicio | Elianhers Banco fecha 27/04/2020
Decripción: Modal para asignar precio
====================================================================
-->

<div class="modal fade" id="assing_price_form-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="assing_price_form">
			  <!-- Modal Header -->
			  <div class="modal-header">
					<h4 class="modal-title pull-left">Assing Price</h4>
					<span class="btn close  cancel_ride_form_close pull-right" data-dismiss="modal"><i class="fa fa-times"></i></span>
			  </div>
			  <!-- Modal body -->
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="user_id" />
						<input type="hidden" name="request_id" />
						<input type="hidden" name="provider_id" value="0"/>
						<input type="number" placeholder="price" name="price" class="form-control" maxlength="5">
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-block shadow-box btn-info" id="assing_price_btn" style=" font-weight: bold;">SUBMIT</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!--
====================================================================
Modificación: fin
====================================================================
-->
