
<div class="container p-3 overflow-auto"> 
	<div class="card "> 
		<div class="row no-gutters card-body">
          <div class="col-md-3">
            <div class="card-identity">
              <img src="<?=base_url('assets/img/umroh1.jpeg')?>" width="230px" height="300px" alt="">
            </div>
          </div>
          <div class="col-md-8 align-self-center">
            <div class="card-body">
                <h3 class="card-title"><?=$nama_paket_travel?></h3>
				<p class="alert alert-danger hide-if-empty" id="error_label"><?php 
					if (isset($error) && $error !== NULL){
						echo  $error;
					}
				?></p>
				<p class="alert alert-primary hide-if-empty" id="message_label"><?php 
					if (isset($message) && $message !== NULL){
						echo  $message;
					}
				?></p>
			  <p class="card-text">Rp <?=$harga_paket_travel?></p>
			  <p class="card-text"><?=$tanggal_keberangkatan?>, <?=$lama_keberangkatan?> hari</p>
              <p><?=$deskripsi_paket_travel?></p>
              <div>
                <a class="btn btn-primary" href="#">Review Paket</a>
                <a class="btn btn-primary" href="<?=base_url("customer/paket/{$id_paket_travel}/foto")?>">Album</a>
              </div>
              
            </div>

		</div>
	</div>
</div>


