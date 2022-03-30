
<div class="container p-3 overflow-auto"> 
	<div class="card "> 
		<div class="card-body">
			<div>
				<div class="float-right">
					<p class="card-text align-middle mb-0"><?php echo $data_paket['tanggal_keberangkatan'] . ', ' . $data_paket['lama_keberangkatan'] . ' hari' ?></p>
					<p class="card-text align-middle"><?php echo 'Rp ' . $data_paket['harga_paket_travel'] ?></p>
				</div>
				<div>
					<h5 class="card-title align-middle mb-0"><?php echo $data_paket['nama_paket_travel'] ?></h5>
					<p class="card-text align-middle"><?php echo $data_paket['ringkasan_paket_travel']; ?></p>
				</div>
			</div>

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
			
			<ul class="nav nav-tabs border-bottom-0 mb-0 pb-0 table-tab">
			  <li class="nav-item border-bottom-0 mb-0 pb-0">
				<a class="nav-link <?php if($mode=='foto') echo 'active'; ?> border-bottom-0 mb-0"
					 data-toggle="tab"
						 href="#tableFoto" 
						onclick="fetch_foto()"
				>Foto</a>
			  </li>
			  <li class="nav-item mb-0 border-bottom-0 pb-0">
				<a class="nav-link <?php if($mode=='anggota') echo 'active'; ?> border-bottom-0 mb-0"  
						data-toggle="tab"
						href="#table_anggota"
						onclick="fetch_anggota()"
				>Anggota</a>
			  </li>
			  <li class="nav-item mb-0 border-bottom-0 pb-0">
				<a class="nav-link <?php if($mode=='album') echo 'active'; ?> border-bottom-0 mb-0"  
						data-toggle="tab"
						href="#table_album"
						onclick="fetch_album()"
				>Album</a>
			  </li>
			</ul>
			
			<div class="tab-content border-top-0 mt-0 pt-0">
				<?php 
					$this->view('travel/admin_foto_grup', array(
						'mode' => $mode,
						'data_photo_crud' => $data_photo_crud,
						'data_paket' => $data_paket
					));
					$this->view('travel/admin_anggota_grup', array(
						'mode' => $mode,
						'data_paket' => $data_paket
					));
					$this->view('travel/admin_album_grup', array(
						'mode' => $mode,
						'data_paket' => $data_paket
					));
				?>
			</div>

		</div>
	</div>
</div>
