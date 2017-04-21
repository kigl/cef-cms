$(function () {
    var buttonItemDelete = $('.selection-item-delete'),
        buttonGroupDelete = $('.selection-group-delete'),
        gridViewCssClass = '.grid-view',
        itemKeys = [],
        groupKeys = [];


    buttonItemDelete.click(function (event) {
        event.preventDefault();

        if (confirmDelete()) {
            buttonItemDelete.closest(gridViewCssClass).find('input[name="selectionItem[]"]:checked').each(function (index, el) {
                itemKeys.push($(el).val());
            });

            console.log(itemKeys);

            ajaxKeys($(this), itemKeys);
        }
    });

    buttonGroupDelete.click(function (event) {
        event.preventDefault();

        if (confirmDelete()) {
            buttonItemDelete.closest(gridViewCssClass).find('input[name="selectionGroup[]"]:checked').each(function (index, el) {
                groupKeys.push($(el).val());
            });

            ajaxKeys($(this), groupKeys);
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

        return confirm(text)
    }

});