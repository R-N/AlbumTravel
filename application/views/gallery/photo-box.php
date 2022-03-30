<div class='card photo-box' id='foto-<?=$id_foto?>' style="
	background-image: url('<?=base_url('foto/'.$id_foto.'/thumb')?>');" onMouseOver="$('#foto-<?=$id_foto?>-overlay').show();" onMouseOut="$('#foto-<?=$id_foto?>-overlay').hide();" onFocusIn="$('#foto-<?=$id_foto?>-overlay').show();" onFocusOut="$('#foto-<?=$id_foto?>-overlay').hide();" >
	<div class='photo-box-overlay p-2 align-middle' id='foto-<?=$id_foto?>-overlay'>
		<textarea class="photo-box-textarea ic-title-field block w-100" data-id="20" id='foto-<?=$id_foto?>-title' autocomplete="off" onFocusIn="$('#foto-<?=$id_foto?>-title').css('resize', 'vertical');$('#foto-<?=$id_foto?>-title').css('height', '5rem');" onFocusOut="$('#foto-<?=$id_foto?>-title').css('resize', 'none');$('#foto-<?=$id_foto?>-title').css('height', '1.5rem');"><?=$judul_foto?></textarea>
		<a class='btn btn-primary btn-sm block my-2' href="#" onclick="previewImage('<?=base_url('foto/'.$id_foto)?>', '<?=$judul_foto?>')">Lihat</a>
		<a href='https://uas4b.sekolahq.id/paket_travel/admin/1/delete_file/20' class='btn btn-danger btn-sm block my-2' tabindex="-1">Hapus</a>
	</div>
</div>