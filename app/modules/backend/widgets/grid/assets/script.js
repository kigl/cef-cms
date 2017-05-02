$(function () {
    var buttonItemDelete = $('.selection-item-delete'),
        buttonGroupDelete = $('.selection-group-delete'),
        gridViewCssClass = '.grid-view',
        keys = [];


    buttonItemDelete.click(function (event) {
        event.preventDefault();

        if (confirmDelete()) {
            $(this).closest(gridViewCssClass).find('input[name="selection[]"]:checked').each(function (index, el) {
                if ($(el).attr('group') === undefined) {
                    keys.push($(el).val());
                }
            });

            ajaxKeys($(this), keys);
        }
    });

    buttonGroupDelete.click(function (event) {
        event.preventDefault();

        if (confirmDelete()) {
            $(this).closest(gridViewCssClass).find('input[name="selection[]"]:checked').each(function (index, el) {
                if ($(el).attr('group') !== undefined) {
                    keys.push($(el).val());
                }
            });

            ajaxKeys($(this), keys);
        }
    });

    var ajaxKeys = function (el, keys) {
        if (keys.length > 0) {
            $.ajax({
                type: 'POST',
                url: el.attr('href'),
                data: {'selection': keys},
                success: function (data) {
                    location.reload();
                }
            });
        }
    };

    function confirmDelete() {
        var text = 'Удалить элемент?';

        return confirm(text);
    }
});