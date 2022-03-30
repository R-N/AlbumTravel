<tr>
	<th scope='row' class='align-middle'><?=$nomor?></th>
	<td class='align-middle'><?=$id_paket_cetak?></td>
	<td class='align-middle'><?=$nama_paket_cetak?></td>
	<td class='align-middle'><?=$harga_dasar?></td>
	<td class='align-middle'><?=$harga_per_halaman?></td>
	<td class='align-middle'>
		<a class="btn btn-danger btn-sm inline" href="<?=base_url('percetakan/paket/'.$id_paket_cetak.'/hapus')?>">Hapus</a>
	</td>
</tr>