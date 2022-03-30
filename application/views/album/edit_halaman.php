
<div class="container p-3 overflow-auto align-middle"> 
	<div class="card"> 
		<div class="card-body" style="background-color:none">
			<div class="clearfix">
				<div class="card-title inline">
					<h5 class="block"><?=$text?></h5>
					<h5 class="block"><?=$judul_album?></h5>
					<h5 class="block"><?=$nama_paket_travel?></h5>
					
				</div>
				
				<a class="btn btn-primary float-right m-2 text-white" id="templatePickerButton">Template</a>
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
			
			<div class="container" style="min-height: 50vh;">
				<div class="row" style="min-height: 50vh;">
					<?php
					if($id_template!=null){
					?>
					<div class="col-sm-6">
						<?php
							$this->view('album/foto_pool', $data_foto_pool);
						?>
					</div>
					<div class="col-sm-6">
						<?php
							$this->view('album/live_edit_halaman', $data);
						?>
					</div>
					<?php } ?>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	function refreshFotoPool(){
		fetch_foto_pool('<?=$data_foto_pool['id_foto_pool']?>', <?=$id_album?>, function(){
			$(".photo-box").each(function(){
				 if($(".area-foto[idFoto='" + $(this).attr('idFoto') + "']").length > 0){
					 $(this).hide();
				 }
			});
		});
		
	}
	$(function(){
		let button = $('#templatePickerButton');
		initTemplatePicker(
		
			<?php if($id_template != null){ ?>
			function(){
				initTemplate("<?=$id_template?>", function(){
					button.text(getSelectedTemplateName());
				})
			}
			<?php } ?>
		
		);
		
		<?php if($id_template != null){ ?>
			refreshLiveEditHalaman(refreshFotoPool);
		<?php } ?>
		
		button.click(
		function(){
			button.text(
				pickTemplate(onTemplatePicked)
			);
		}
		);
	});
	function onTemplatePicked(idTemplate){
		<?php
		if($id_template != null){
		?>
		if(idTemplate == <?=$id_template?>) return;
		<?php
		}
		?>
		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "<?=base_url('album/set_template')?>",
			data: {
				id_halaman: <?=$id_halaman?>,
				id_template: idTemplate
			},
			success:function(data){
				if(data.result=="OK"){
					location.reload();
				}else{
					$('#error_label').text(data.error);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				$('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
				$('#error_label').append($('<div>').html(xhr.responseText));
			}
		});
	}
</script>
