
<div class="modal fade" id="templatemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Pilih Template</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
            <p class="alert alert-danger hide-if-empty" id="templatemodal_error_label"><?php 
                if (isset($error) && $error !== NULL){
                    echo  $error;
                }
            ?></p>
            <p class="alert alert-primary hide-if-empty" id="templatemodal_message_label"><?php 
                if (isset($message) && $message !== NULL){
                    echo  $message;
                }
            ?></p>
          <div class="dropdown m-2 inline">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="templateGroupDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Kelompok Template
              </button>
              <div class="dropdown-menu" aria-labelledby="templateGroupDropdownButton">
              </div>
            </div>
            <div class="dropdown m-2 inline">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="templateDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pilih Template
              </button>
              <div class="dropdown-menu" aria-labelledby="templateDropdownButton">
              </div>
            </div>
            <img class="p-2" src="" id="templatePreview" style="width: 100%; object-fit: cover;" >
      </div>
      <div class="modal-footer" id='templatePickerFooter'>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="templatePrevButton">Sebelumnya</button>
        <button type="button" class="btn btn-success btn-block" id="templatePickButton">Pilih</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="templateNextButton">Selanjutnya</button>
      </div>
    </div>
  </div>
</div>
<script>
    var templateGroups = {};
    var templates = {};
    var selectedTemplateGroup = 0;
    var selectedTemplate = 0;
    function onSelectTemplateGroup(idTemplateGroup, callback=null){
        if(selectedTemplateGroup==idTemplateGroup) return;
        selectedTemplateGroup = idTemplateGroup;
        $('#templateGroupDropdownButton').text(templateGroups[idTemplateGroup].nama_grup_template);
        
        $.ajax({
            type : "POST",
            url  : "<?=base_url('album/fetch_template')?>",
            dataType : "JSON",
            data : {id_grup_template: idTemplateGroup},
            success: function(data){
                
                $('#templatemodal_error_label').empty();
                if(data.result== 'OK'){
                    let buttons = $('#templateDropdownButton+.dropdown-menu')
                    buttons.empty();
                    templateGroups[selectedTemplateGroup].entries = {};
                    for(i = 0; i < data.entries.length; ++i){
                        let entry = data.entries[i];
                        buttons.append($('<button>')
                            .addClass('dropdown-item')
                            .addClass('btn')
                            .on('click', function(){
                                onSelectTemplate(entry.id_template);
                            })
                            .text(entry.text)
                        );
                        templateGroups[selectedTemplateGroup].entries[entry.id_template] = entry;
                        templates[entry.id_template] = entry;
                    }
                    if(callback!=null) callback();
                }else{
                    $('#templatemodal_error_label').text(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#templatemodal_error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#templatemodal_error_label').append($('<div>').html(xhr.responseText));
            }
        });
        
        $('#templateDropdownButton').show();
    }
    function onSelectTemplate(idTemplate, callback=null){
        if(selectedTemplate==idTemplate) return;
        selectedTemplate = idTemplate;
        $('#templateDropdownButton').text(templates[idTemplate].text);
        $('#templatePreview').attr('src', templates[idTemplate].url_template + ".png");
        $('#templatePickerFooter').show();
        $('#templatePreview').show();
        if(callback!=null) callback();
    }
    function pickTemplate(callback){
        if(selectedTemplate==null){
            $('#templateDropdownButton').hide();
            $('#templatePickerFooter').hide();
            $('#templatePreview').hide();
        }else{
            $('#templateDropdownButton').show();
            $('#templatePickerFooter').show();
            $('#templatePreview').show();
        }
        
        $('#templatePickButton').prop("onclick", null).off("click");
        $('#templatePickButton').click(function(){
            callback(selectedTemplate);
            $('#templatemodal').modal('hide');
        });
            
        $('#templatemodal').modal('toggle');
    }
    
    function initTemplate(idTemplate, callback=null){
        $.ajax({
            type : "POST",
            url  : "<?=base_url('album/get_id_grup_template')?>",
            dataType : "JSON",
            data : {
                id_template: idTemplate
            },
            success: function(data){
                $('#templatemodal_error_label').empty();
                if(data.result== 'OK'){
                    onSelectTemplateGroup(data.id_grup_template, function(){
                        onSelectTemplate(idTemplate, callback);
                    });
                }else{
                    $('#templatemodal_error_label').text(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#templatemodal_error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#templatemodal_error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    
    function getSelectedTemplateName(){
        if(selectedTemplate == null || selectedTemplate <1){
            return null;
        }
        return templates[selectedTemplate].nama_template;
    }
    
    function initTemplatePicker(callback=null){
        $.ajax({
            type : "POST",
            url  : "<?=base_url('album/fetch_grup_template')?>",
            dataType : "JSON",
            data : {},
            success: function(data){
                
                $('#templatemodal_error_label').empty();
                if(data.result== 'OK'){
                    let buttons = $('#templateGroupDropdownButton+.dropdown-menu');
                    buttons.empty();
                    for(i = 0; i < data.entries.length; ++i){
                        let entry = data.entries[i];
                        buttons.append($('<button>')
                            .addClass('dropdown-item')
                            .addClass('btn')
                            .on('click', function(){
                                onSelectTemplateGroup(entry.id_grup_template);
                            })
                            .text(entry.nama_grup_template)
                        );
                        templateGroups[entry.id_grup_template] = entry;
                    }
                    if(callback!=null)callback();
                }else{
                    $('#templatemodal_error_label').text(data.error);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('#templatemodal_error_label').append($('<div>').html(xhr.status + ' : ' + thrownError));
                $('#templatemodal_error_label').append($('<div>').html(xhr.responseText));
            }
        });
    }
    
</script>