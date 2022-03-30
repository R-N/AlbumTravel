
	<div class="card" >
		<?php if(isset($url_gambar_percetakan)) { ?>
		<img src="<?=$url_gambar_percetakan?>" class="card-img-top" alt="...">
		<?php } ?>
		<div class="card-body">
		  <h5 class="card-title"><?=$nama_percetakan?></h5>
		  <p class="card-text"><?=$ringkasan_percetakan?></p>
			<a href="javascript:void(0)" class="btn btn-primary" onclick="onSelectPercetakan(<?=$id_percetakan?>)">Pilih</a>
		</div>
	</div>