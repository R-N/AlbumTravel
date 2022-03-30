<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="imagemodallabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="imagemodallabel">Image preview</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%; object-fit: cover;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	function previewImage(link, title='Image Preview'){
		$('#imagemodallabel').text(title);
		$('#imagepreview').attr('src', link);
		$('#imagemodal').modal('toggle');
	}
</script>