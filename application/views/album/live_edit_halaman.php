
<?php 
	$data = array(
		'url_template' => $url_template,
		'url_grup_template' => $url_grup_template
	);
	$this->view($url_template . '.php', $data);
?>
<script>
	function refreshLiveEditHalaman(callback=null){
		$.ajax({
			url: "<?=base_url("album/fetch_foto_halaman")?>",
			dataType: "JSON",
			type: "POST",
			data: {
				id_halaman: <?=$id_halaman?>
			},
			success: function(data){
				if(data.result=='OK'){
					for(i=0;i<data.entries.length;++i){
						let entry = data.entries[i];
						$('.area-foto[urutanFoto="' + entry.urutan_foto_halaman + '"]')
							.css('background-image', 'url("<?=base_url("foto/")?>' + entry.id_foto + '")')
							.attr('idFoto', entry.id_foto);
					}
					if(callback != null) callback();
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
	$( ".area-foto" ).droppable({
		greedy: true,
		tolerance: 'pointer',
		drop: function( event, ui ) {
			let thisbox = $(this);
			let idFoto = ui.draggable.attr('idFoto');
			let urutan = parseInt($(this).attr('urutanFoto'));
			let data = {
				id_foto: idFoto,
				id_halaman: <?=$id_halaman?>,
				urutan_foto: urutan
			};
			$('#error_label').empty();
			$.ajax({
			  url: "<?=base_url("album/set_foto_halaman")?>",
			  dataType: "JSON",
			  type: "POST",
			  data: data,
			  success: function(data){
				if(data.result=='OK'){
					ui.draggable.hide();
					let oldId = thisbox.attr('idFoto');
					if(oldId > 0){
						let hiddenBox = $('#foto-' + oldId);
						if(hiddenBox.length > 0){
							hiddenBox.trigger("mouseout");
							hiddenBox.show();
						}else{
							alert('Old photo box not found');
						}
					}
					thisbox.attr('idFoto', ui.draggable.attr('idFoto'));
					thisbox.css('background-image', 'url("<?=base_url("foto/")?>' + idFoto + '")');
					setTimeout(function(){
						$('.area-foto').droppable("enable");
					}, 500);
				}else{
					$('#error_label').append($('<div>').text(data.error));
				}
			  },
				error: function (xhr, ajaxOptions, thrownError) {
					$('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
					$('#error_label').append($('<div>').html(xhr.responseText));
				}
		  });
	   
	  },
		over: function(event, ui){
			let thisbox = $(this);
			let zindex = parseInt(thisbox.css('z-index'));
			if(zindex == null) zindex = 1;
			$(".area-foto").filter(function(){
				return !$(this).is(thisbox) && parseInt($(this).css('z-index')) <= zindex;
			}).each(function(){
				$(this).droppable( "disable" );
			});
		},
		out: function(event, ui){
			$('.area-foto').droppable("enable");
		}
	});
</script>