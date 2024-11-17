
<div class="container p-3 overflow-auto"> 
    <div class="card "> 
        <div class="card-body">
            <h5 class="card-title">Tambah Paket cetak</h5>

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

            <div>
                <div class="form-group">
                    <label for="nama-field">Nama</label>
                    <input type="input" class="form-control" name="nama" id="nama-field" placeholder="Masukkan nama paket"/>
                </div>
                <div class="form-group">
                    <label for="deskripsi-field">Deskripsi</label>
                    <textarea type="input" class="form-control" name="deskripsi" id="deskripsi-field" placeholder="Deskripsikan paket cetak anda"/></textarea>
                </div>
                <div class="form-group">
                    <label for="ringkasan-field">Ringkasan</label>
                    <input type="input" class="form-control" name="ringkasan" id="ringkasan-field" placeholder="Masukkan ringkasan dari deskripsi paket cetak"/>
                </div>
                <div class="form-group">
                    <label for="harga-dasar-field">Harga dasar</label>
                    <input type="number" class="form-control" name="harga" id="harga-dasar-field" placeholder="Masukkan harga dasar dari paket cetak"/>
                    <small id="harga-dasar-help" class="form-text text-muted">Harga dinyatakan dalam Rupiah.</small>
                </div>
                <div class="form-group">
                    <label for="harga-per-halaman-field">Harga per halaman</label>
                    <input type="number" class="form-control" name="harga" id="harga-per-halaman-field" placeholder="Masukkan harga per halaman dari paket cetak"/>
                    <small id="harga-per-halaman-help" class="form-text text-muted">Harga dinyatakan dalam Rupiah.</small>
                </div>
                
                <div class="container clearfix">
                    <div class="row">
                        <div class="col p-1">
                            <button class="btn btn-primary w-100" type="submit" name="Tambahkan" id="btn_submit" value="Login">Tambahkan</button>
                        </div>
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
    $('#tanggal-field').datepicker({
        uiLibrary: 'bootstrap4',
        format: "yyyy-mm-dd"
    });
    $('#btn_submit').on('click',function(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
                    url  : "<?=base_url('percetakan/insert_paket_cetak')?>",
                    dataType : "JSON",
                    data : {
                        nama_paket_cetak:$('#nama-field').val(), 
                        deskripsi_paket_cetak:$('#deskripsi-field').val(), 
                        ringkasan_paket_cetak:$('#ringkasan-field').val(), 
                        harga_dasar:$('#harga-dasar-field').val(),
                        harga_per_halaman:$('#harga-per-halaman-field').val()
                    },
                    success: function(data){
                        $('#error_label').empty();
                        if(data.result== 'OK'){
                            $.redirect(data.redirect, data.data);
                        }else{
                            $('#error_label').text(data.error);
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#error_label').append($('<div>').html(xhr.responseText));
                    }
                });
        });
</script>