
  <div class="col-lg-3 col-md-3 my-2 my-lg-2">
	<div class="card" >
		<?php if(isset($url_gambar_paket_travel)) { ?>
		<img src="<?=$url_gambar_paket_travel?>" class="card-img-top" alt="...">
		<?php } ?>
		<div class="card-body">
		  <h5 class="card-title"><?=$nama_paket_travel?></h5>
		  <p class="card-text">Rp <?=$harga_paket_travel?></p>
		  <p class="card-text"><?=$tanggal_keberangkatan?>, <?=$lama_keberangkatan?> hari</p>
		  <p class="card-text"><?=$ringkasan_paket_travel?></p>
			<?php if($status_anggota_grup ==1){?>
				<a href="<?=base_url('customer/paket/'.$id_paket_travel)?>" class="btn btn-primary">Lihat</a>
			<?php }else if ($status_anggota_grup==0){ ?>
				<p class="card-text alert alert-warning">Menunggu Persetujuan</p>
			<?php } ?>
		</div>
	</div>
  </div>