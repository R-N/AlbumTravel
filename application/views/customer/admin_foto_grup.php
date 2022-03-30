
<form action="<?=$data_photo_crud['url_upload_foto']?>"  method="post" enctype="multipart/form-data" class="dropzone tab-pane fade <?php if($mode=='foto') echo 'show active'; ?> bg-dark p-3 text-white" id="tableFoto" >
	<?php $this->view('gallery/photo-crud', $data_photo_crud); ?>
</form>

<script>
	Dropzone.options.tableFoto = {
	  paramName: "foto", // The name that will be used to transfer the file
	  maxFilesize: 2, // MB
	  createImageThumbnails: true,
	  acceptedFiles: ".jpg,.png",
	  dictDefaultMessage: "Klik atau taruh foto di sini untuk upload",
	  sending: function(file, xhr, formData){
		  formData.append('file_name', file.name);
		  $("#tableFoto>.dz-message").hide();
	  },
	  success: function(file, response){
		  $('#error_label').empty();
		  
		  let data = JSON.parse(response);
		  
		  $("#<?=$data_photo_crud['id_photo_crud']?>").prepend($("<li>").addClass("clearfix").append(data.view));
		
			file.previewElement.remove();
			
		if($('#tableFoto>.dz-preview').length == 0){
			$("#tableFoto>.dz-message").css("display", "block");
		}
	  },
	  error: function(file, response){
			$('#error_label').append($('<div>').html(response));
	  },
	  init: function(){
			myDropzone = $('#tableFoto');
			myDropzone.on("complete", function(file) {
				myDropzone.removeFile(file);
			});
	  },
	  accept: function(file, done) {
		  
		  done();
	  }
	};
</script>