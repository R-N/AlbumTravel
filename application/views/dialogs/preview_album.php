<div class="modal fade" id="halamanmodal" tabindex="-1" role="dialog" aria-labelledby="halamanmodallabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="halamanmodallabel">halaman preview</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
		<p class="alert alert-danger hide-if-empty" id="templatemodal_error_label"><?php 
			if (isset($error) && $error !== NULL){
				echo  $error;
			}
		?></p>
		<p class="alert alert-primary hide-if-empty" id="templatemodal_message_label"><?php 
			if (isset($message) && $message !== NULL){
				echo  $message;
			}
		?></p>

		<div class="dropdown m-2 inline">
		  <button class="btn btn-secondary dropdown-toggle" type="button" id="halamanDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Pilih halaman
		  </button>
		  <div class="dropdown-menu" aria-labelledby="halamanDropdownButton">
		  </div>
		</div>
        <div id="halamanpreview" style="width: 100%; object-fit: cover; min-height: 50vh;" ></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	var halaman = {};
	var selectedHalaman = null;
	function previewAlbum(id_album){
		
		$.ajax({
			type : "POST",
			url  : '<?=base_url("album/fetch_halaman"); ?>',
			dataType : "JSON",
			data:{
				id_album: id_album,
				raw: true
			},
			success: function(data){
				let buttons = $('#halamanDropdownButton+.dropdown-menu');
				buttons.empty();
				for(i = 0; i < data.entries.length; ++i){
					let entry = data.entries[i];
					entry.text = "Halaman " + entry.nomor_halaman;
					halaman[parseInt(entry.id_halaman)] = entry;
					buttons.append($('<button>')
						.addClass('dropdown-item')
						.addClass('btn')
						.on('click', function(){
							console.log("ONCLICK " + entry.id_halaman);
							onSelectHalaman(entry.id_halaman);
						})
						.text(entry.text)
					);
				}
				onSelectHalaman(data.entries[0].id_halaman);
				$('#halamanmodal').modal('toggle');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
				$('#error_label').append($('<div>').html(xhr.responseText));
			}
		});
	}
	function onSelectHalaman(id_halaman){
		selectedHalaman = id_halaman;
		entry = halaman[id_halaman];
		$('#halamanDropdownButton').text(entry.text);
		previewHalaman(entry.id_album, entry.nomor_halaman);
	}
	function previewHalaman(id_album, nomor_halaman){
		$.ajax({
			url: "<?=base_url("album/preview_halaman")?>",
			dataType: "JSON",
			type: "POST",
			data: {
				nomor_halaman: nomor_halaman,
				id_album:id_album
			},
			success: function(data){
				if(data.result=='OK'){
					$('#halamanpreview').html(data.view);
					$('#halamanpreview').first().css('height', '50vh');
					$('#halamanmodallabel').text(data.text + " " + data.judul_album);
				}else{
					$('#error_label').append($('<div>').text(data.error));
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
				$('#error_label').append($('<div>').html(xhr.responseText));
			}
		});
	}
</script>