
<div class="container p-3 "> 
	<div class="row "> 
		<div class="col-sm-5 offset-sm-2 card align-middle centered center-vertical"> 
			<div class="card-body">
				<h5 class="card-title">Login</h5>

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
						<label for="username">Username</label>
						<input type="input" class="form-control" name="username" id="username_field" placeholder="Masukkan username Anda"/>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password_field" placeholder="Masukkan password Anda"/>
					</div>
					<div class="container clearfix">
						<div class="row">
							<div class="col-sm p-1">
								<button class="w-100 btn btn-primary" type="submit" name="login" id="btn_login" value="Login">Login</button>
							</div>
							<div class="col-sm p-1">
								<a class="w-100 btn btn-primary inline align-middle" href="">Lupa password</a>
							</div>
							<div class="col-sm dropdown inline show p-1">
								<button class="w-100 btn btn-primary inline dropdown-toggle" type="button" data-toggle="dropdown">Daftar<span class="caret"></span></button>
								<ul class="dropdown-menu">
									<a class="dropdown-item" href="<?=base_url('register/customer')?>">Sebagai Customer</a>
									<a class="dropdown-item" href="<?=base_url('register/travel')?>">Sebagai Agen Travel</a>
									<a class="dropdown-item" href="<?=base_url('register/percetakan')?>">Sebagai Percetakan</a>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	$('#btn_login').on('click',function(){
		let username = $('#username_field').val();
		let password = $('#password_field').val();
		$('#message_label').empty();
		$.ajax({
			type : "POST",
			url  : "<?=base_url('auth/login_process')?>",
			dataType : "JSON",
			data : {username:username, password:password},
			success: function(data){
				$('#error_label').empty();
				if(data.result== 'OK'){
					window.location.replace(data.redirect);
				}else{
					$('#error_label').text(data.error);
				}
                	},
			error: function (xhr, ajaxOptions, thrownError) {
				$('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
				$('#error_label').append($('<div>').html(xhr.responseText));
			}
		});
	});
</script>