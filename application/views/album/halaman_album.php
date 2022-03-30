

<section class="sheet padding-10mm" id_halaman="<?=$id_halaman?>">
	<?php 
		if($url_template != null){
			$data = array(
				'url_template' => $url_template,
				'url_grup_template' => $url_grup_template
			);
	?>
	<div class="my-body-print">
	<?php
			$this->view($url_template . '.php', $data);
	?>
	</div>
	<div class="my-body-print">
	<?php
			$this->view($url_template . '.php', $data);
	?>
	</div>
	<?php 
		}else{
			echo 'Halaman ini belum memiliki template';
		}
	?>
</section>
<script>
	function refreshPreviewHalaman(id_halaman){
		$.ajax({
			url: "<?=base_url("album/fetch_foto_halaman")?>",
			dataType: "JSON",
			type: "POST",
			data: {
				id_halaman: id_halaman
			},
			success: function(data){
				if(data.result=='OK'){
					for(i=0;i<data.entries.length;++i){
						let entry = data.entries[i];
						$('section[id_halaman="' + id_halaman + '"] .area-foto[urutanFoto="' + entry.urutan_foto_halaman + '"]')
							.css('background-image', 'url("<?=base_url("foto/")?>' + entry.id_foto + '")')
							.attr('idFoto', entry.id_foto);
					}
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
<?php if($url_template != null){ ?>
	$(function(){
		refreshPreviewHalaman(<?=$id_halaman?>);
		console.log("Load halaman <?=$id_halaman?>");
	});
<?php } ?>
</script>