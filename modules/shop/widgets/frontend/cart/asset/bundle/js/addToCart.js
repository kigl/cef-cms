function addToCart(productId, count) {

    var urlTo = '/shop/cart/add';
    $.ajax({
        type: 'POST',
        url: urlTo,
        data: {"productId": productId, "count": count},
        success: function (data) {
            //alert(data);
        }
    });

    // обновляем корзину
    setTimeout( function () {
        $.pjax.reload({container:"#cart-pjax"});  //Reload GridView
    }, 400);
}