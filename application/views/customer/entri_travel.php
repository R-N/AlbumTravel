
  <div class="col-lg-3 col-md-3 my-2 my-lg-2">
	<div class="card" >
		<?php if(isset($url_gambar_travel)) { ?>
		<img src="<?=$url_gambar_travel?>" class="card-img-top" alt="...">
		<?php } ?>
		<div class="card-body">
		  <h5 class="card-title"><?=$nama_travel?></h5>
		  <p class="card-text"><?=$ringkasan_travel?></p>
			<a href="<?=base_url('customer/travel/'.$id_travel)?>" class="btn btn-primary">Lihat</a>
		</div>
	</div>
  </div>