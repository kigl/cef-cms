function addToCart(productId, qty) {
    var urlTo = '/shop/cart/add';
    $.ajax({
        type: 'POST',
        url: urlTo,
        data: {"productId": productId, "qty": qty},
        success: function (data) {
            alert('Товар добавлен в корзину');
        }
    });

    // обновляем корзину
    setTimeout( function () {
        $.pjax.reload({container:"#cart-pjax"});  //Reload GridView
    }, 200);
}