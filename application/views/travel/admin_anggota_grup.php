
<div class="tab-pane fade  <?php if($mode=='anggota') echo 'show active'; ?>  border-top-0 mt-0 pt-0" id="table_anggota">
  <div id="wrapper p-3 overflow-auto align-middle">

    <!-- Sidebar -->
    

    <div id="content-wrapper">

      <div class="container-fluid mx-0 px-0">

        <!-- Breadcrumbs-->
        

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTableAnggota" width="100%" cellspacing="0">
                <caption id="entry_count"></caption>
                <thead>
                  <tr>
                      <th class="border-top-0 mt-0" scope="col">#</th>
                      <th class="border-top-0 mt-0" scope="col">ID</th>
                      <th class="border-top-0 mt-0" scope="col">Nama</th>
                      <th class="border-top-0 mt-0" scope="col">Telepon</th>
                      <th class="border-top-0 mt-0" scope="col">Rating</th>
                      <th class="border-top-0 mt-0" scope="col">Action</th>
                  </tr>
                </thead>
                  <tbody id="tbody_anggota" onload="fetch_anggota()">
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <p class="small text-center text-muted my-5">
          <em></em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
</div>

<script>
    function terima_anggota(id_anggota_grup){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url()?>" +'travel/anggota/'+id_anggota_grup+'/terima',
            dataType : "JSON",
            data:{
                id_anggota_grup: id_anggota_grup
            },
            success: function(data){
                if(data.result=="OK"){
                    alert("Berhasil");
                    fetch_anggota();
                }else{
                    console.log(JSON.stringify(data));
                    $('#error_label').append($('<div>').html(data.error));
                }
                    
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function hapus_anggota(id_anggota_grup){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url()?>" +'travel/anggota/'+id_anggota_grup+'/hapus',
            dataType : "JSON",
            data:{
                id_anggota_grup: id_anggota_grup
            },
            success: function(data){
                if(data.result=="OK"){
                    alert("Berhasil");
                    fetch_anggota();
                }else{
                    console.log(JSON.stringify(data));
                    $('#error_label').append($('<div>').html(data.error));
                }
                    
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function fetch_anggota(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('travel/paket/' . $data_paket['id_paket_travel'] . '/anggota/fetch')?>",
            dataType : "JSON",
            data:{
                id_paket_travel: <?php echo $data_paket['id_paket_travel'] ?>
            },
            success: function(data){
                $('#error_label').empty();
                //$('#entry_count').text('Entri ' + data.start + ' hingga ' + data.end + ' dari ' + data.count + ' entri.');
                $('#tbody_anggota').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    $('#tbody_anggota').append(data.entries[i]);
                }
                $("#dataTableAnggota").DataTable();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    $(function(){
        fetch_anggota();
    });
</script>