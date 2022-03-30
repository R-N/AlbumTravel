
<div class="container p-3 "> 
	<div class="row "> 
		<div class="col-sm-6 offset-sm-2 card align-middle centered center-vertical"> 
			<div class="card-body container">
				<div class="row">
					<h5 class="col-sm card-title">Masuk sebagai...</h5>
				</div>

				
				<div class="row">
				<p class="col-sm alert alert-danger hide-if-empty" id="error_label"><?php 
					if (isset($error) && $error !== NULL){
						echo  $error;
					}
				?></p>
				</div>
				<div class="row">
				<p class="col-sm alert alert-primary hide-if-empty" id="message_label"><?php 
					if (isset($message) && $message !== NULL){
						echo  $message;
					}
				?></p>
				</div>

				<div class="row">
					<a class="col-sm btn btn-primary m-2" href="<?=base_url('customer')?>">Customer</a>
				</div>
				<div class="row">
					<a class="col-sm btn btn-primary m-2" href="<?=base_url('travel')?>">Travel</a>
				</div>
				<div class="row">
					<a class="col-sm btn btn-primary m-2" href="<?=base_url('percetakan')?>">Percetakan</a>
				</div>
				<div class="row">
					<a class="col-sm btn btn-primary m-2" href="<?=base_url('admin')?>">Admin</a>
				</div>

			</div>
		</div>
	</div>
</div>