
<div id="content-wrapper">

  <div class="container-fluid">


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
                <th scope="col">ID</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Alamat</th> 
                <th scope="col">Telepon</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Lunas</th>
                <th scope="col">Dikirim</th>
                <th scope="col">Diterima</th>
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
    function fetch(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('admin/fetch_pesanan_rinci')?>",
            dataType : "JSON",
            data:{
                id_album: <?=$id_album?>
            },
            headers: {
                'Authorization': 'Bearer YOUR_TOKEN',
                'Custom-Header': 'CustomValue'
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
