$(function () {
    commentForm = $('#comment-form');

    $('.link-answer').click(function () {
        linkAnswer = $(this);
        commentItem = linkAnswer.parent().parent().parent().parent().parent();

        linkAnswer.parent().append(commentForm);
        $('#comment-input-parent_id').val(commentItem.find('input[type="hidden"]').val());
    });

    commentForm.on('beforeSubmit', function (event) {
        return false;
    });

    commentForm.on('afterValidate', function (event, attribute, messages, deferreds) {
        $('#result span').text(attribute.message);
    });
});