<tr>
	<th scope='row' class='align-middle'><?=$nomor?></th>
	<td class='align-middle'><?=$id_album?></td>
	<td class='align-middle'><?=$judul_album?></td>
	<td class='align-middle'><?=$jumlah_pesanan_album?></td>
	<td class='align-middle'>
		<a class="btn btn-primary btn-sm inline text-white" onclick="pesan_album(<?=$id_album?>)">Pesan</a>
		<a class="btn btn-primary btn-sm inline text-white" onclick="previewAlbum(<?=$id_album?>)">Preview</a>
		<?php if($jenis_album==1){ ?>
		<?php } else {?>
			<a class="btn btn-primary btn-sm inline" href="<?=base_url("album/{$id_album}")?>">Admin</a>
			<a class="btn btn-danger  btn-sm inline" href="<?=base_url("album/{$id_album}/hapus")?>">Hapus</a>
		<?php } ?>
	</td>
</tr>
<script>
	$(function(){
		
	});
</script>