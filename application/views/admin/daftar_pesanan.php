
<div id="content-wrapper">

  <div class="container-fluid">

    <!-- Breadcrumbs-->
    <?php $this->load->view("dialogs/pilih_percetakan"); ?>

    <!-- DataTables Example -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
       Daftar Pesanan</div>
      <div class="card-body">
        <p class="alert alert-danger hide-if-empty" id="error_label"><?php 
            if (isset($error) && $error !== NULL){
                echo  $error;
            }
        ?></p>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <caption id="entry_count"></caption>
            <thead>
              <tr>
                <th scope="col">Nama Album</th>
                <th scope="col">Nama Travel</th>
                <th scope="col">Pilihan Paket</th> 
                <th scope="col">File Album</th>
                <th scope="col">Percetakan</th>
                <th scope="col">Paket Cetak</th>
                <th scope="col">Jumlah Pesanan</th>
              </tr>
            </thead>
              <tbody id="tbody_main">
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
<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        async: false,
    });
    function onPilihPaketCetak(idAlbum, idPaketCetak){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('admin/set_paket_cetak')?>",
            dataType : "JSON",
            data:{
                id_album: idAlbum,
                id_paket_cetak: idPaketCetak
            },
            success: function(data){
                if(data.result == "OK"){
                    $('#tbody_main [id_album="' + idAlbum + '"] .nama_paket_cetak').text(paketCetak[idPaketCetak].nama_paket_cetak);
                    let idPercetakan = paketCetak[idPaketCetak].id_percetakan;
                    $('#tbody_main [id_album="' + idAlbum + '"] .nama_percetakan').text(percetakan[idPercetakan].nama_percetakan);
                }else{
                    $('#error_label').append($('<div>').html(data.error));
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function fetch(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('admin/fetch_pesanan')?>",
            dataType : "JSON",
            data:{
            },
            success: function(data){
                if(data.result == "OK"){
                    $('#error_label').empty();
                    $('#tbody_main').empty();
                    let len = data.entries.length;
                    for(i=0; i < len; ++i){
                        let entry = data.entries[i];
                        $('#tbody_main').append(entry);
                    }
                    $("#dataTable").DataTable();
                }else{
                    $('#error_label').append($('<div>').html(data.error));
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
