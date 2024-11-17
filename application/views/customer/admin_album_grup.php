
<div class="tab-pane fade  <?php if($mode=='anggota') echo 'show active'; ?>  border-top-0 mt-0 pt-0" id="table_album">
  <div id="wrapper p-3 overflow-auto align-middle">

    <!-- Sidebar -->
    

    <div id="content-wrapper">

      <div class="container-fluid mx-0 px-0">

        <!-- Breadcrumbs-->
        

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTableAlbum" width="100%" cellspacing="0">
                <caption id="entry_count"></caption>
                <thead>
                  <tr>
                      <th class="border-top-0 mt-0" scope="col">#</th>
                      <th class="border-top-0 mt-0" scope="col">ID</th>
                      <th class="border-top-0 mt-0" scope="col">Judul</th>
                      <th class="border-top-0 mt-0" scope="col">Pesanan</th>
                      <th class="border-top-0 mt-0" scope="col">Action</th>
                  </tr>
                </thead>
                  <tbody id="tbody_album" onload="fetch_album()">
                </tbody>
              </table>
                <a class="btn btn-primary block float-right m-2 text-white" id="addAlbumButton">Tambah</a>
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
<div class="tab-pane fade  <?php if($mode=='album') echo 'show active'; ?>  border-top-0 mt-0 pt-0" id="table_album">
    <table class="table table-striped table-bordered  border-top-0 mt-0 pt-0" onload="fetch_album()">
      <thead class="thead-dark border-top-0 mt-0 pt-0">
        <tr class="mt-0 pt-0" >
          <th class="border-top-0 mt-0" scope="col">#</th>
          <th class="border-top-0 mt-0" scope="col">ID</th>
          <th class="border-top-0 mt-0" scope="col">Judul</th>
          <th class="border-top-0 mt-0" scope="col">Pesanan</th>
          <th class="border-top-0 mt-0" scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="tbody_album"></tbody>
      <caption id="entry_count"></caption>
    </table>
    <a class="btn btn-primary block float-right m-2 text-white" id="addAlbumButton">Tambah</a>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    $(function(){
        $('#addAlbumButton').click(function(){
            askInput("Buat Album", "", "Masukkan judul album", add_album);
        });
    });
    function pesan_album(id_album){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/pesan_album'); ?>",
            dataType : "JSON",
            data:{
                id_album: id_album,
                id_paket_travel: <?=$id_paket_travel?>
            },
            success: function(data){
                if(data.result=='OK'){
                    $('#error_label').empty();
                    alert("berhasil");
                    fetch_album();
                }else{
                    $('#error_label').text($('<div>').html(data.error));
                }
                    
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function add_album(judul_album){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/tambah_album'); ?>",
            dataType : "JSON",
            data:{
                id_paket_travel: <?php echo $data_paket['id_paket_travel'] ?>,
                judul_album: judul_album
            },
            success: function(data){
                if(data.result=='OK'){
                    $('#error_label').empty();
                    fetch_album();
                }else{
                    $('#error_label').text($('<div>').html(data.error));
                }
                    
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function fetch_album(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('customer/paket/' . $data_paket['id_paket_travel'] . '/album/fetch'); ?>",
            dataType : "JSON",
            data:{
                id_paket_travel: <?php echo $data_paket['id_paket_travel'] ?>
            },
            success: function(data){
                $('#error_label').empty();
                //$('#entry_count').text('Entri ' + data.start + ' hingga ' + data.end + ' dari ' + data.count + ' entri.');
                $('#tbody_album').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    $('#tbody_album').append(data.entries[i]);
                }
                $('#dataTableAlbum').DataTable();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    $(function(){
        fetch_album();
    });
</script>