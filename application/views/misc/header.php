<div class="p-0 clearfix fixed-top">
    <nav class='navbar bg-dark navbar-dark header clearfix  py-2  '>
        <?php if(isset($nama_pengguna) && $nama_pengguna !== NULL){ 
        ?>
        <button class="btn btn-secondary px-3 py-1" onclick="toggleNav()">≡</button>
        <?php  }  ?>
        <div class='text-white site-name inline align-middle mr-auto ml-2 mb-0'><?php echo SITE_NAME ?></div>
        <?php if(isset($nama_pengguna) && $nama_pengguna !== NULL){ 
        ?>
            <div class="login-info inline ">
                <div class="text-white inline align-middle px-2">Terlogin sebagai <?=$nama_pengguna?></div>
                
                <button type="button" class="btn btn-danger btn-sm inline" onclick="askConfirmation('Konfirmasi logout', 'Apa Anda yakin ingin logout?', logout)">Logout</button>
            </div>
        <?php 
        } 
        ?>
        
    </nav>
</div>

<?php
$this->view('dialogs/confirmation2');
?>
<?php if(isset($nama_pengguna) && $nama_pengguna !== NULL) { ?>
<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        async: true,
    });
    function logout(){
        $.ajax({
            type : "POST",
            url  : "<?=base_url('/logout')?>",
            dataType : "JSON",
            success: function(data){
                window.location.replace(data.redirect);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " : " + thrownError);
            }
        });
    }
</script>
<?php } ?>

