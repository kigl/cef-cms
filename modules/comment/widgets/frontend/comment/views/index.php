<script>
    $( function () {
        $('.test').click( function () {
            loop = $(this).parent().parent();
            //alert(loop.find('input[type="text"]').val());
            $('.comment-item-comment').html(loop);
            $('#kill').val(loop.find('input[type="text"]').val())
        });
    });
</script>

<?= $this->render('_item', [
        'data' => $data,
        'parentId' => null,
    ]);?>

<a name="comment"></a>
<div class="comment-item-comment"></div>
<?php
if (!Yii::$app->user->isGuest) {
    echo $this->render('_form', ['data' => $data]);
}
?>