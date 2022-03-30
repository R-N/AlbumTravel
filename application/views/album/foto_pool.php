
<ul class='photos-crud clearfix' id="<?=$id_foto_pool?>">

</ul>
<script>
function fetch_foto_pool(id_foto_pool, id_album, callback=null){
	$.ajax({
		type : "POST",
		url  : "<?=base_url('album/fetch_foto')?>",
		dataType : "JSON",
		data:{
			id_album: id_album
		},
		success: function(data){
			$('#'+id_foto_pool).empty();
			let len = data.entries.length;
			for(i=0; i < len; ++i){
				$('#'+id_foto_pool).append(data.entries[i]);
			}
			if(callback != null) callback();
		},
		error: function (xhr, ajaxOptions, thrownError) {
				$('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
				$('#error_label').append($('<div>').html(xhr.responseText));
		}
	});
}


</script>