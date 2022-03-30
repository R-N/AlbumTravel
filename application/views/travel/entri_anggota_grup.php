<tr>
	<th scope='row' class='align-middle'><?=$nomor?></th>
	<td class='align-middle'><?=$id_customer?></td>
	<td class='align-middle'><?=$nama_customer?></td>
	<td class='align-middle'><?=$telepon_customer?></td>
	<td class='align-middle'><?=$rating_paket_travel?></td>
	<td class='align-middle'>
		<a class="btn btn-primary btn-sm inline" href="<?=base_url('travel/anggota/'.$id_anggota_grup)?>">Lihat</a>
		<?php if($status_anggota_grup==0){ ?>
			<a class="btn btn-success btn-sm inline text-white" onclick="terima_anggota(<?=$id_anggota_grup?>)">Terima</a>
		<?php } ?>
		<a class="btn btn-danger  btn-sm inline text-white" onclick="hapus_anggota(<?=$id_anggota_grup?>)"><?php echo ($status_anggota_grup==0?'Tolak':'Hapus')?></a>
	</td>
</tr>