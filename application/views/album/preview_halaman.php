<div style="width:100%;height:100%;margin:0;padding:0;" >
<?php 
    if($url_template != null){
        $data = array(
            'url_template' => $url_template,
            'url_grup_template' => $url_grup_template
        );
        $this->view($url_template . '.php', $data);
    }else{
        echo 'Halaman ini belum memiliki template';
    }
?>
</div>
<script>
    function refreshPreviewHalaman(callback=null){
        $.ajax({
            url: "<?=base_url("album/fetch_foto_halaman")?>",
            dataType: "JSON",
            type: "POST",
            data: {
                id_halaman: <?=$id_halaman?>
            },
            success: function(data){
                if(data.result=='OK'){
                    for(i=0;i<data.entries.length;++i){
                        let entry = data.entries[i];
                        $('.area-foto[urutanFoto="' + entry.urutan_foto_halaman + '"]')
                            .css('background-image', 'url("<?=base_url("foto/")?>' + entry.id_foto + '")')
                            .attr('idFoto', entry.id_foto);
                    }
                    if(callback != null) callback();
                }else{
                    $('#error_label').append($('<div>').text(data.error));
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
<?php if($url_template != null){ ?>
    $(function(){
        refreshPreviewHalaman();
    });
<?php } ?>
</script>