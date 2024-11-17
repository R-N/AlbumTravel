
<div class="container p-3 overflow-auto align-middle"> 
    <div class="card "> 
        <div class="card-body">
            <div class="clearfix">
                <h5 class="card-title inline align-middle">Daftar Paket Travel</h5>
                
                <a class="btn btn-primary float-right m-2" href="<?=base_url('customer/travel')?>">Tambah</a>
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

              <div class="container-fluid p-3 overflow-auto align-middle">
                <!-- DataTables Example -->
                <div class="test">
                    <div class="row" id="paketHolder">
                    </div>
                </div>
              </div>
              <!-- /.container-fluid -->
              <script>
              </script>

        </div>
    </div>
</div>
<script>
    function fetch(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/paket/fetch'); ?>",
            dataType : "JSON",
            data:{
            },
            success: function(data){
                $('#error_label').empty();
                $('#entry_count').text('Entri ' + data.start + ' hingga ' + data.end + ' dari ' + data.count + ' entri.');
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
    fetch();
</script>
