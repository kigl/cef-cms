<div class="modal fade" id="modal-login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs("
$('#show-modal-login').click(function() {
        $('#modal-login').modal('show');
        var url = $(this).attr('href');
        var modal = $('.modal-body');
         $.get(url, function(data) {
            modal.html(data);
          });
         return false;
});
")
?>