<tr>
	<th scope='row' class='align-middle'><?=$nomor?></th>
	<td class='align-middle'><?=$id_halaman?></td>
	<td class='align-middle'><?=$nomor_halaman?></td>
	<td class='align-middle'><?="{$nama_grup_template} - {$nama_template}"?></td>
	<td class='align-middle'>
		<?php 
		if ($jumlah_foto > 0) {
			echo "{$jumlah_foto_halaman}/{$jumlah_foto}";
		}else{
			echo "-";
		}
		?>
	</td>
	<td class='align-middle'>
		<a class="btn btn-primary btn-sm inline" href="<?=base_url("album/{$id_album}/{$nomor_halaman}/edit")?>">Atur</a>
		<?php if($id_template != null){ ?>
		<button class="btn btn-primary btn-sm inline" onclick="previewHalaman(<?=$id_album?>, <?=$nomor_halaman?>)">Preview</button>
		<?php } ?>
		<a class="btn btn-danger  btn-sm inline" href="<?=base_url("album/{$id_album}/{$nomor_halaman}/hapus")?>">Hapus</a>
	</td>
</tr>