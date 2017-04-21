$(function () {
    commentForm = $('#comment-form');
    cloneCommentForm = commentForm.clone();

    $('.link-answer').click(function () {
        linkAnswer = $(this);
        commentItem = linkAnswer.parent().parent().parent().parent().parent();

        linkAnswer.parent().append(cloneCommentForm);
        $('#comment-input-parent_id').val(commentItem.find('input[type="hidden"]').val());
    });
});