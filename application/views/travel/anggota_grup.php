
<div class="container p-3 align-middle"> 
	<div class="card "> 
		<div class="card-body">
			<h5 class="card-title"><?=$nama_customer?></h5>
			<p class="card-text">Anggota dari grup <?=$nama_paket_travel?></p>

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



			<div>
				<div class="form-group">
					<label for="alamat-field">Alamat</label>
					<p class="form-control" name="nama" id="alamat-field"><?=$alamat_customer?></p>
				</div>
				<div class="form-group">
					<label for="telepon-field">Telepon</label>
					<p class="form-control" name="nama" id="telepon-field"><?=$telepon_customer?></p>
				</div>
				
				<div class="form-group">
					<label for="telepon-field">Paket yang pernah diikuti</label>
					<table class="table table-striped table-bordered" onload="fetch()">
					  <caption id="entry_count"></caption>
					  <thead class="thead-dark">
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">ID</th>
						  <th scope="col">Nama</th>
						  <th scope="col">Tanggal Berangkat</th>
						  <th scope="col">Aksi</th>
						</tr>
					  </thead>
					  <tbody id="tbody_main"></tbody>
					</table>
				</div>
				
				
				<div class="container clearfix">
					<div class="row">
						<div class="col p-1">
							<?php if($status_anggota_grup==0){?>
								<a class="btn btn-success inline" id="btn_accept" href="<?=base_url('travel/anggota/'.$id_anggota_grup.'/terima')?>">Terima</a>
							<?php } ?>
							<a class="btn btn-danger inline"  href="<?=base_url('travel/anggota/'.$id_anggota_grup.'/hapus')?>"><?php echo ($status_anggota_grup==0?'Tolak':'Hapus')?></a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
</script>