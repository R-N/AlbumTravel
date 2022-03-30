
  <div class="col-lg-5 col-md-5 my-3 my-lg-3">
	<div class="card" >
		<?php if(isset($url_gambar_paket_cetak)) { ?>
		<img src="<?=$url_gambar_paket_cetak?>" class="card-img-top" alt="...">
		<?php } ?>
		<div class="card-body">
		  <h5 class="card-title"><?=$nama_paket_cetak?></h5>
		  <p class="card-text">Rp <?=$harga_dasar?> + Rp <?=$harga_per_halaman?>/hlm</p>
		  <p class="card-text"><?=$ringkasan_paket_cetak?></p>
			<a class="btn btn-primary text-white" onclick="onSelectPaketCetak(<?=$id_paket_cetak?>)">Pilih</a>
		</div>
	</div>
</div>