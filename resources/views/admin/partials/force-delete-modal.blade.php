<!-- Modal -->
<div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" action="" id="delete-form">
				{{ method_field('DELETE') }}
				@csrf
				<div class="modal-header bg-danger white">
					<h5 class="modal-title" id="myModalLabel120">Confirm Deletion </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<input type="hidden" name="force" value="1" />
				<div class="modal-body">
					<b>Heads up! This alert needs your attention !!! </b>
					<br />
					<br />
					<b style="color:red">Are you sure to delete this item?</b>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Confirm</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
 function confirm_modal(route) {
  jQuery('#danger').modal('show');
  let forms = document.querySelector('#delete-form');
  forms.setAttribute('action', route)
 }
</script>
