<!-- Modal -->
<div class="modal fade" id="input_dialog" tabindex="-1" role="dialog" aria-labelledby="input_dialogLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title" id="input_dialogLabel">Tolong isi judul konfirmasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-2">
			<p class="alert alert-danger hide-if-empty" id="input_dialog_error_label"></p>
			<div id="input_dialogBody">
				Tolong isi badan konfirmasi
			</div>
			<div class="form-group">
				<input type="input" class="form-control" name="input" id="input_field" placeholder=""/>
			</div>
      </div>
      <div class="modal-footer py-2">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="alert('Tolong berikan callback');$('input_dialog').modal('hide');" id="input_dialog_btn_primary">OK</button>
      </div>
    </div>
  </div>
</div>
<script>
	function askInput(title, body, placeholder, callback){
		$('#input_dialogLabel').text(title);
		$('#input_dialogBody').text(body);
		$('#input_field').attr('placeholder', placeholder);
		$('#input_dialog_btn_primary').prop("onclick", null).off("click");
		$('#input_dialog_btn_primary').click(function(){
			let text=$('#input_field').val();
			if(text == ''){
				$('#input_dialog_error_label').text("Input tidak boleh kosong");
				return;
			}
			$('#input_dialog_error_label').text("");
			$('#input_dialog').modal('hide');
			callback(text);
		});
		
		$('#input_dialog').modal('toggle');
		$('#input_field').focus();
	}
</script>