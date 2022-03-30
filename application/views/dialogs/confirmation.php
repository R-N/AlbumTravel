<!-- Modal -->
<div class="modal fade" id="<?=$dialog_id?>" tabindex="-1" role="dialog" aria-labelledby="<?=$dialog_id?>Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?=$dialog_id?>Label"><?=$dialog_title?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $dialog_body; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$dialog_cancel_text?></button>
        <button type="button" class="btn btn-primary" onclick="<?=$dialog_on_confirm?>" id="<?=$dialog_id?>_btn_primary"><?=$dialog_confirm_text?></button>
      </div>
    </div>
  </div>
</div>