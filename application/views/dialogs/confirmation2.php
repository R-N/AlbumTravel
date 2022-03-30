<!-- Modal -->
<div class="modal fade" id="confirm_dialog" tabindex="-1" role="dialog" aria-labelledby="confirm_dialogLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirm_dialogLabel">Tolong isi judul konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="confirm_dialogBody">
		Tolong isi badan konfirmasi
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="alert('Tolong berikan callback');$('confirm_dialog').modal('hide');" id="confirm_dialog_btn_primary">Ya</button>
      </div>
    </div>
  </div>
</div>
<script>
	function askConfirmation(title, body, callback){
		$('#confirm_dialogLabel').text(title);
		$('#confirm_dialogBody').text(body);
		$('#confirm_dialog_btn_primary').prop("onclick", null).off("click");
		$('#confirm_dialog_btn_primary').click(function(){
			$('#confirm_dialog').modal('hide');
			callback();
		});
		
		$('#confirm_dialog').modal('toggle');
	}
</script>