
  <div id="wrapper p-3 overflow-auto align-middle">

    <!-- Sidebar -->
    

    <div id="content-wrapper">

      <div class="container-fluid mt-3">

        <!-- Breadcrumbs-->
        

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
                <i class="fas fa-table"></i>
               Daftar Paket Cetak
                <a class="btn btn-primary float-right m-2" href="<?=base_url('percetakan/paket/tambah')?>">Tambah</a>
           </div>
          <div class="card-body">
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
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTablePaket" width="100%" cellspacing="0">
                <caption id="entry_count"></caption>
                <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">ID</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Harga Dasar</th>
                      <th scope="col">Harga Per Halaman</th>
                      <th scope="col">Aksi</th>
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

  </div>
  <!-- /#wrapper -->

<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        async: false,
    });
    function fetch(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('percetakan/paket/fetch'); ?>",
            dataType : "JSON",
            data:{
            },
            success: function(data){
                $('#error_label').empty();
                //$('#entry_count').text('Entri ' + data.start + ' hingga ' + data.end + ' dari ' + data.count + ' entri.');
                $('#tbody_main').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    let entry = data.entries[i];
                    $('#tbody_main').append(entry);
                }
                $("#dataTablePaket").DataTable();
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
