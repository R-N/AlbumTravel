
<ul class='photos-crud clearfix' id="<?=$id_photo_crud?>">

</ul>
<script>
    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    function fetch_foto(id_photo_crud, id_paket_travel){
        $.ajax({
            type : "POST",
            url  : "<?=$url_photo_crud?>",
            dataType : "JSON",
            data:{
                id_paket_travel: id_paket_travel
            },
            success: function(data){
                $('#'+id_photo_crud).empty();
                let len = data.entries.length;
                for(i=0; i < len; ++i){
                    $('#'+id_photo_crud).append($('<li>').addClass('clearfix').append(data.entries[i]));
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                    $('#error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                    $('#error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }


    $(document).ready(function(html) {
        fetch_foto('<?=$id_photo_crud?>', <?=$id_paket_travel?>);
    });
</script>