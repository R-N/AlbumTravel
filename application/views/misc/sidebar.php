



<div id="mySidenav" class="sidenav" style="line-height:1;">
	<?php
		//if(isset($nav_groups)){
			foreach($nav_groups as $nav_group){
	?>
				  <li class="nav-item py-0 my-0">
					<a class="nav-link my-0" href="<?=$nav_group['url']?>"><?=$nav_group['text']?></a>
				  </li>
	<?php
				foreach($nav_group['nav_items'] as $nav_item){
	?>
				  <li class="nav-item py-0 my-0">
					<a class="nav-link my-0" href="<?=$nav_item['url']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$nav_item['text']?></a>
				  </li>
	<?php
				}
			}
		//}
	?>
</div>
<script>
var navOpen = false;
function openNav() {
  document.getElementById("mySidenav").style.width = "20vw";
  navOpen = true;
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  navOpen = false;
}
function toggleNav(){
	if(navOpen) closeNav();
	else openNav();
}
</script>