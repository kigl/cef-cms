<html>
<head>
    <link rel="stylesheet" href="/public/assets/b68d4d45/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../coupon/css/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../coupon/js/jquery.cookie.js"></script>
</head>
<body>

<?php
require 'service/business.php';
// $modelForm CouponForm
?>

<button class="btn btn-get-money" id="buttonOpenCoupon">
    Получить 500 рублей
</button>

<div id="pp">
    <div class="coupon-window">
        <div class="row">
            <div class="col-md-12">
                <form method="post" id="coupon-form">
                    <!--<div class="message js-form-message"></div>-->
                    <div class="panel-body">
                        <button type="button" id="close-coupon" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        <div class="coupon-header">
                            <h1>500 рублей в подарок</h1>
                            <p>на первую покупку!*</p>
                        </div>
                        <div class="coupon-input indent-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="CouponForm[name]" value="<?= $modelForm->name;?>" class="form-control" placeholder="Имя"/>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="CouponForm[email]" value="<?= $modelForm->email;?>" class="form-control" placeholder="Email"/>
                                </div>
                            </div>
                        </div>
                        <div class="coupon-button indent-top">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="submit" id="submit" value="Получить купон" class="btn btn-coupon"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coupon-condition help-block text-center">
                                    *Сделайте единовременный заказ на сумму 5000 руб. и получите 500руб. в подарок на
                                    эту
                                    покупку.<br/>
                                    Не является договором публичной оферты.
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--<div id="pp-bg"></div>-->

<script src="../coupon/js/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../coupon/js/script.js"></script>
<script src="/public/assets/b68d4d45/js/bootstrap.min.js"></script>
</body>
</html>