<?php 
	setlocale(LC_TIME, 'id_ID'); 
	setlocale(LC_TIME, 'IND'); 
	setlocale(LC_TIME, 'INDONESIA'); 
?>
<div class="my-body">
	<link rel="stylesheet" type="text/css" href="<?=base_url($url_template.'.css')?>">
	<script src="<?=base_url('assets/js/jquery.fittext.js')?>"></script>
	<div class="layer layer-1">&nbsp;</div>
	<div class="layer layer-2">&nbsp;</div>
	<div class="layer layer-3">
		<div class="layer layer-4">
			<div class="layer layer-5">&nbsp;</div>
		</div>
		<div class="layer layer-6">
			<div class="layer layer-7">
				<div class="layer layer-8">
					<div class="layer layer-9">
						<div class="layer layer-img area-foto" id="foto_1" urutanFoto="1">
							&nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-number center-horizontal"><?=$nomor_halaman?></div>
	<div class="title-1">Perjalanan Ibadah</div>
	<div class="title-2-shadow">Umroh</div>
	<div class="title-2-shadow title-2">Umroh</div>
	<div class="badge">
		<img src="<?=base_url($url_grup_template.'Logo2.png')?>" class="badge-logo">
	</div>
	<div class="date-div">
		<div class="date"><b><i><?=date('d F Y', strtotime($tanggal_keberangkatan));?> - <?=date('d F Y', strtotime($tanggal_kembali));?></i></b></div>
		<div class="hashtag"><b><i>#ayokeMakkah</i></b></div>
	</div>
	<div class="img-div-border img-div-big-border">
		<div class="img-div img-div-big area-foto" id="foto_2" urutanFoto="2">&nbsp;</div>
	</div>
	<div class="img-div-border img-div-medium-border">
		<div class="img-div img-div-medium area-foto" id="foto_3" urutanFoto="3">&nbsp;</div>
	</div>
	<div class="img-div-border img-div-small-border">
		<div class="img-div img-div-small area-foto" id="foto_4" urutanFoto="4">&nbsp;</div>
	</div>
	<img class="cover-pattern" src="<?=base_url($url_grup_template.'cover-pattern.png')?>">
</div>
<script>
<?php if(!isset($print)){ ?>
	function fixTexts(){
		  $(".title-1").fitText(0.85);
		  $(".title-2-shadow").fitText(0.31);
		  $(".page-number").fitText(0.13);
		  $(".date").fitText(1.19);
		  $(".hashtag").fitText(1.33);
		  $(".badge").fitText();
	}
	$(function(){
		fixTexts();
		setTimeout(fixTexts, 500);
	});
<?php } ?>
</script>