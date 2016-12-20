<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        $('.form-product a ').click( function () {
            var parent = $(this).parent(),
                input = parent.find('input');

            $.ajax({
                type: 'POST',
                url: '/shop/ajax/index',
                data: input,
                success: function (data) {
                    alert(data);
                }
            });

            return false;
        });
    });
</script>
<span class="result"></span>

<div class="form-product">
    <input type="text" name="toCart[12]"/>
    <a href="#">press</a>
</div>

<div class="form-product">
    <input type="text" name="toCart[14]"/>
    <a href="#">press</a>
</div>
<div class="form-product">
    <input type="text" name="toCart[16]"/>
    <a href="#">press</a>
</div>