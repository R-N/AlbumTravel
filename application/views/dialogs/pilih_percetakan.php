
<?php $this->view("dialogs/pilih_paket_cetak"); ?>
<!-- Modal -->
<div class="modal fade" id="percetakanModal" tabindex="-1" role="dialog" aria-labelledby="percetakanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="percetakanModalLabel">Pilih Percetakan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-3 overflow-auto align-middle">
            <div class="row" id="percetakanHolder">
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    var pilihPaketCetakCallback = null;
    var percetakan = {};
    function onSelectPercetakan(idPercetakan){
        $('#percetakanModal').modal('hide');
        pilihPaketCetak(idPercetakan);
    }
    function fetchPercetakan(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('admin/fetch_percetakan'); ?>",
            dataType : "JSON",
            data:{
            },
            success: function(data){
                $('#error_label').empty();
                $('#percetakanHolder').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    let entry = data.entries[i];
                    $('#percetakanHolder').append(entry);
                    console.log(JSON.stringify(entry));
                    let raw_entry = data.raw_entries[i];
                    percetakan[raw_entry.id_percetakan] = raw_entry;
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }

    $(function(){
        fetchPercetakan();
    });

    function pilihPercetakan(callback){
        pilihPaketCetakCallback = callback;
        $('#percetakanModal').modal('toggle');
    }
</script>