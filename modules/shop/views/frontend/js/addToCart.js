function addToCart(productId, count) {

    var urlTo = '/shop/ajax/index';
    $.ajax({
        type: 'POST',
        url: urlTo,
        data: {"toCart": {"productId": productId, "count": count}},
        success: function (data) {
            alert(data);
        }
    });

    return false;
}