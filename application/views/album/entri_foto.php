<li class='card photo-box btn m-2 clearfix' id='foto-<?=$id_foto?>' idFoto="<?=$id_foto?>" style="
	background-image: url('<?=base_url('foto/'.$id_foto.'/thumb')?>');" onMouseOver="$('#foto-<?=$id_foto?>-overlay').show();" onMouseOut="$('#foto-<?=$id_foto?>-overlay').hide();" onFocusIn="$('#foto-<?=$id_foto?>-overlay').show();" onFocusOut="$('#foto-<?=$id_foto?>-overlay').hide();" >
	<div class='photo-box-overlay p-2 align-middle' id='foto-<?=$id_foto?>-overlay'>
		<p class="block center photo-box-title px-3 py-2" data-id="20" id='foto-<?=$id_foto?>-title'><?=$judul_foto?></p>
	</div>
</li>
<script>
  $( function() {
	  let thisbox = $( "#foto-<?=$id_foto?>" );
    thisbox.draggable({
		revert:'invalid',
		helper: 'clone',
		start: function(e, ui) {
			ui.helper.width($(this).width());
			$(this).css('visibility', 'hidden');
		},
		stop: function(e, ui) {
			$(this).css('visibility', '');
		}
	});
  });
</script>