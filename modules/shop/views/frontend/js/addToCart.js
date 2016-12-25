function addToCart(productId, count) {

    var urlTo = '/shop/cart/add';
    $.ajax({
        type: 'POST',
        url: urlTo,
        data: {"productId": productId, "count": count},
        success: function (data) {
            alert(data);
        }
    });

    return false;
}