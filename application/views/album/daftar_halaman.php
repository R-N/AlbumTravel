
  <div id="wrapper p-3 overflow-auto align-middle">

    <!-- Sidebar -->
    

    <div id="content-wrapper">

      <div class="container-fluid mt-3">

        <!-- Breadcrumbs-->
        

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
                <div class="card-title inline">
                    <h5 class="block"><?=$judul_album?></h5>
                    <h5 class="block"><?=$nama_paket_travel?></h5>
                </div>
                
                <a class="btn btn-primary float-right m-2  text-white" id="addPageButton">Tambah</a>
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
              <table class="table table-bordered" id="dataTableHalaman" width="100%" cellspacing="0">
                <caption id="entry_count"></caption>
                <thead>
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">ID</th>
                      <th scope="col">Halaman</th>
                      <th scope="col">Template</th>
                      <th scope="col">Foto</th>
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
<script>
    $(function(){
        let button=$("#addPageButton");
        
        initTemplatePicker();
        
        button.click(
            function(){
                button.text(
                    pickTemplate(onTemplatePicked)
                );
            }
        );
        
    });
    function onTemplatePicked(idTemplate){
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?=base_url('album/tambah_halaman')?>",
            data: {
                id_album: <?=$id_album?>,
                id_template: idTemplate
            },
            success:function(data){
                console.log(JSON.stringify(data));
                if(data.result=="OK"){
                    //$('#tbody_main').append(data.entry);
                    fetch();
                }else{
                    $('#error_label').text(data.error);
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
            url  : '<?=base_url("album/fetch_halaman"); ?>',
            dataType : "JSON",
            data:{
                id_album: <?=$id_album?>
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
                $('#dataTableHalaman').DataTable();
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
