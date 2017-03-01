<?php
\app\modules\comment\widgets\frontend\comment\views\asset\Asset::register($this);
?>

<script>
    $(function () {
        $('.link-answer').click(function () {
            // сонтейнер комментария
            commentItem = $(this).parent().parent().parent().parent().parent();

            $('.container-answer-item-comment').html(commentItem.clone()).find('.comment-footer').remove();
            $('#comment-input-parent_id').val(commentItem.find('input[type="hidden"]').val());
        });
    });
</script>

<?= $this->render('_item', [
    'data' => $data,
    'parentId' => null,
]); ?>


<?php if (!Yii::$app->user->isGuest) : ?>
    <div class="well well-sm">
        <a name="comment-anchor"></a>
        <div class="container-answer-item-comment"></div>
        <?= $this->render('_form', ['data' => $data]); ?>
    </div>
<?php endif; ?>
