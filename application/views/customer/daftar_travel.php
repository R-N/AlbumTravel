
<div class="container p-3 overflow-auto align-middle"> 
    <div class="card "> 
        <div class="card-body">
            <div class="clearfix">
                <h5 class="card-title inline align-middle">Daftar Travel</h5>
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
                    <div class="row" id="travelHolder">
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
    function fetch(page=1, search=null){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/fetch_travel'); ?>",
            dataType : "JSON",
            data:{
                page: page,
                search: search
            },
            success: function(data){
                $('#error_label').empty();
                //$('#entry_count').text('Entri ' + data.start + ' hingga ' + data.end + ' dari ' + data.count + ' entri.');
                $('#travelHolder').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    let entry = data.entries[i];
                    $('#travelHolder').append(entry);
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
