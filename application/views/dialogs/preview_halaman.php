<div class="modal fade" id="halamanmodal" tabindex="-1" role="dialog" aria-labelledby="halamanmodallabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="halamanmodallabel">halaman preview</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <p class="alert alert-danger hide-if-empty" id="templatemodal_error_label"><?php 
            if (isset($error) && $error !== NULL){
                echo  $error;
            }
        ?></p>
        <p class="alert alert-primary hide-if-empty" id="templatemodal_message_label"><?php 
            if (isset($message) && $message !== NULL){
                echo  $message;
            }
        ?></p>
        <div id="halamanpreview" style="width: 100%; object-fit: cover; min-height: 50vh;" ></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        async: false,
    });
    function previewHalaman(id_album, nomor_halaman){
        $.ajax({
            url: "<?=base_url("album/preview_halaman")?>",
            dataType: "JSON",
            type: "POST",
            data: {
                nomor_halaman: nomor_halaman,
                id_album:id_album
            },
            success: function(data){
                if(data.result=='OK'){
                    $('#halamanpreview').html(data.view);
                    $('#halamanpreview').first().css('height', '50vh');
                    $('#halamanmodallabel').text(data.text + " " + data.judul_album);
                    $('#halamanmodal').modal('toggle');
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
</script>