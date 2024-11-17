
<div class="container p-3 overflow-auto align-middle"> 
    <div class="card "> 
        <div class="card-body">
            <h5 class="card-title inline align-middle"><?=$nama_travel?></h5>
            <div class="card-text"><?=$ringkasan_travel?></div>
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

              <div class="container-fluid p-3 overflow-auto align-middle">
                <!-- DataTables Example -->
                <div class="test">
                    <div class="row" id="paketHolder">
                    </div>
                </div>
              </div>

        </div>
    </div>
</div>
<script>
    function join_grup(id_paket_travel){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/join_grup'); ?>",
            dataType : "JSON",
            data:{
                id_paket_travel: id_paket_travel
            },
            success: function(data){
                $('#error_label').empty();
                if(data.result=='OK'){
                    alert("Berhasil join");
                    
                    fetch();
                }else{
                    $('#error_label').append($('<div>').html(data.error));
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').empty();
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function fetch(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/fetch_paket_travel_public'); ?>",
            dataType : "JSON",
            data:{
                id_travel: <?=$id_travel?>
            },
            success: function(data){
                $('#error_label').empty();
                //$('#entry_count').text('Entri ' + data.start + ' hingga ' + data.end + ' dari ' + data.count + ' entri.');
                $('#paketHolder').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    let entry = data.entries[i];
                    $('#paketHolder').append(entry);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    $(function(){
        fetch();
    });
</script>
