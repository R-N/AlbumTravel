
<div class="container p-3 overflow-auto"> 
    <div class="card "> 
        <div class="card-body">
            <h5 class="card-title">Daftar sebagai Agen Travel</h5>

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
                    <label for="username-field">Username</label>
                    <input type="input" class="form-control" name="username" id="username-field" placeholder="Masukkan username akun travel"/>
                </div>
                <div class="form-group">
                    <label for="password-field">Password</label>
                    <input autocomplete="new-password" type="password" class="form-control" name="password" id="password-field" placeholder="Masukkan password akun travel"/>
                </div>
                <div class="form-group">
                    <label for="password-confirm-field">Konfirmasi Password</label>
                    <input autocomplete="new-password" type="password" class="form-control" name="password-confirm" id="password-confirm-field" placeholder="Masukkan password lagi"/>
                </div>
                <div class="form-group">
                    <label for="email-field">Email</label>
                    <input type="input" class="form-control" name="email" id="email-field" aria-describedby="email-help" placeholder="Masukkan alamat email akun travel"/>
                    <small id="email-help" class="form-text text-muted">Email ini digunakan hanya untuk konfirmasi dan pemulihan akun dan tidak akan ditampilkan.</small>
                </div>
                <div class="form-group">
                    <label for="contact-email-field">Email</label>
                    <input type="input" class="form-control" name="contact-email" id="contact-email-field" aria-describedby="email-help" placeholder="Masukkan alamat email travel yang ingin ditampilkan"/>
                    <small id="contact-email-help" class="form-text text-muted">Email ini akan ditampilkan sebagai salah satu kontak travel. Email ini boleh sama dengan email sebelumnya.</small>
                </div>
                
                <div class="form-group">
                    <label for="nama-field">Nama Travel</label>
                    <input type="input" class="form-control" name="nama" id="nama-field" placeholder="Masukkan nama agen travel"/>
                </div>
                <div class="form-group">
                    <label for="alamat-field">Alamat</label>
                    <input type="input" class="form-control" name="nama" id="alamat-field" placeholder="Masukkan alamat agen travel"/>
                    <small id="telepon-help" class="form-text text-muted">Alamat akan ditampilkan sebagai keterangan agen travel.</small>
                </div>
                <div class="form-group">
                    <label for="telepon-field">Telepon</label>
                    <input type="input" class="form-control" name="nama" id="telepon-field" placeholder="Masukkan nomor telepon Anda"/>
                    <small id="telepon-help" class="form-text text-muted">Nomor telepon akan ditampilkan sebagai kontak agen travel.</small>
                </div>
                <div class="form-group">
                    <label for="deskripsi-field">Deskripsi</label>
                    <textarea type="input" class="form-control" name="nama" id="deskripsi-field" placeholder="Deskripsikan agen travel anda"/></textarea>
                </div>
                <div class="form-group">
                    <label for="ringkasan-field">Ringkasan</label>
                    <input type="input" class="form-control" name="nama" id="ringkasan-field" placeholder="Masukkan ringkasan dari deskripsi agen travel"/>
                </div>
                
                <div class="container clearfix">
                    <div class="row">
                        <div class="col p-1">
                            <button class="btn btn-primary w-100" type="submit" name="Daftar" id="btn_register" value="Login">Daftar</button>
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
    $('#btn_register').on('click',function(){
        $('#message_label').empty();
        $.ajax({
            type : "POST",
                    url  : "<?=base_url('auth/register_process/travel')?>",
                    dataType : "JSON",
                    data : {
                        username:$('#username-field').val(), 
                        password:$('#password-field').val(), 
                        password_confirm:$('#password-confirm-field').val(), 
                        email:$('#email-field').val(), 
                        contact_email:$('#contact-email-field').val(), 
                        nama:$('#nama-field').val(), 
                        alamat:$('#alamat-field').val(),
                        telepon:$('#telepon-field').val(),
                        deskripsi:$('#deskripsi-field').val(),
                        ringkasan:$('#ringkasan-field').val()
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