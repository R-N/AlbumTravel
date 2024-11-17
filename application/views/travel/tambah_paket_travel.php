
<div class="container p-3 overflow-auto"> 
    <div class="card "> 
        <div class="card-body">
            <h5 class="card-title">Tambah Paket Travel</h5>

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
                    <label for="tanggal-field">Tanggal Keberangkatan</label>
                    <input type="text" class="form-control datepicker"  data-date-format="yyyy-mm-dd" name="tanggal" id="tanggal-field" placeholder="Masukkan tanggal keberangkatan"/>
                    <small id="tanggal-help" class="form-text text-muted">Tanggal dalam format yyyy-mm-dd.</small>
                </div>
                <div class="form-group">
                    <label for="lama-field">Lama Keberangkatan</label>
                    <input type="number" class="form-control" name="lama" id="lama-field" placeholder="Masukkan lama keberangkatan"/>
                    <small id="lama-help" class="form-text text-muted">Lama keberangkatan dinyatakan dalam hari.</small>
                </div>
                <div class="form-group">
                    <label for="deskripsi-field">Deskripsi</label>
                    <textarea type="input" class="form-control" name="deskripsi" id="deskripsi-field" placeholder="Deskripsikan paket travel anda"/></textarea>
                </div>
                <div class="form-group">
                    <label for="ringkasan-field">Ringkasan</label>
                    <input type="input" class="form-control" name="ringkasan" id="ringkasan-field" placeholder="Masukkan ringkasan dari deskripsi paket travel"/>
                </div>
                <div class="form-group">
                    <label for="harga-field">Harga</label>
                    <input type="number" class="form-control" name="harga" id="harga-field" placeholder="Masukkan harga dari deskripsi paket travel"/>
                    <small id="harga-help" class="form-text text-muted">Harga dinyatakan dalam Rupiah.</small>
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
    $('#tanggal-field').datepicker({
            uiLibrary: 'bootstrap4',
            dateFormat: "yy-mm-dd"
    });
    $('#btn_submit').on('click',function(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
                    url  : "<?=base_url('travel/insert_paket_travel')?>",
                    dataType : "JSON",
                    data : {
                        nama_paket_travel:$('#nama-field').val(), 
                        tanggal_keberangkatan:$('#tanggal-field').val(), 
                        lama_keberangkatan:$('#lama-field').val(), 
                        deskripsi_paket_travel:$('#deskripsi-field').val(), 
                        ringkasan_paket_travel:$('#ringkasan-field').val(), 
                        harga_paket_travel:$('#harga-field').val()
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