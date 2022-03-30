<tr>
	<th scope='row' class='align-middle'><?=$nomor?></th>
	<td class='align-middle'><?=$id_paket_travel?></td>
	<td class='align-middle'><?=$nama_paket_travel?></td>
	<td class='align-middle'><?=$tanggal_keberangkatan?></td>
	<td class='align-middle'>
		<a class="btn btn-primary btn-sm inline" href="<?=base_url('travel/paket/'.$id_paket_travel.'/foto')?>">Admin</a>
		<a class="btn btn-danger btn-sm inline" href="<?=base_url('travel/paket/'.$id_paket_travel.'/hapus')?>">Hapus</a>
	</td>
</tr>