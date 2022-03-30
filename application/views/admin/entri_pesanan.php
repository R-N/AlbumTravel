<tr id_album="<?=$id_album?>">
  <td><?=$judul_album?></td>
  <td><?=$nama_travel?></td>
  <td><?=$nama_paket_travel?></td>
  <td><a  href="<?=base_url("album/full/".$id_album)?>" target="_blank" class="btn"><i class="fa fa-download"></i> Download</a></td>
  <td class="nama_percetakan"><?=$nama_percetakan==null?"-":$nama_percetakan?></td>
  <td>
	<button type="button" class="btn btn-warning nama_paket_cetak" onclick="pilihPercetakan(function(idPaketCetak){onPilihPaketCetak(<?=$id_album?>, idPaketCetak);})">
		<?=$nama_paket_cetak==null?"Pilih Paket":$nama_paket_cetak?>
	</button>
  </td>
  <td>
	<a type="button" class="btn btn-primary" href="<?=base_url('admin/pesanan/'.$id_album)?>">
		<?=$jumlah_pesanan?>
	</a>
  </td>
 </tr>