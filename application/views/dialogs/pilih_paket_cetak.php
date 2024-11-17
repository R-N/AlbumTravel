
<div class="modal fade" id="paketCetakModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Paket Cetak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid p-3 overflow-auto align-middle">
            <div class="row" id="paket_cetakHolder">
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
        },
        async: false,
    });
    var paketCetak = {};
    function onSelectPaketCetak(idPaketCetak){
        pilihPaketCetakCallback(idPaketCetak);
        $('#paketCetakModal').modal('hide');
    }
    function fetchPaketCetak(idPercetakan){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
            url  : "<?=base_url('admin/fetch_paket_cetak'); ?>",
            dataType : "JSON",
            data:{
                id_percetakan: idPercetakan
            },
            success: function(data){
                $('#error_label').empty();
                $('#paket_cetakHolder').empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    let entry = data.entries[i];
                    $('#paket_cetakHolder').append(entry);
                    let raw_entry = data.raw_entries[i];
                    paketCetak[raw_entry.id_paket_cetak] = raw_entry;
                }
                $('#paketCetakModal').modal('toggle');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    function pilihPaketCetak(idPercetakan){
        fetchPaketCetak(idPercetakan);
    }

</script>