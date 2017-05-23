<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="container">
    <div class="row">
        <div class="col-md-12 margin-bottom-10 underline underline-default">
            <div class="row">
                <div class="col-md-2">
                    <h3>Информация</h3>
                    <ul class="list-unstyled">
                        <li><?= Html::a('Контакты', ['/page/default/view', 'id' => 1]) ?></li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <p class="text-justify">
                    </p>
                    <h3>Женская одежда</h3>
                    Ваш стиль, шарм и индивидуальность в дизайнерской женской одежде «АНО»
                    Женская одежда оптом доступна не только нашим проверенным клиентам, но и всем тем, кто желает
                    привлечь в свои магазины больше покупательниц. Добро пожаловать в Мир «АНО»!
                    <p></p>
                </div>
                <div class="col-md-5">
                    <p class="text-justify">
                    </p>
                    <h3>Контакты</h3>
                    Телефон: <a href="tel:88003503242">8 800 350-32-42</a>
                    <br>
                    Mail: mail@anomoda.ru
                    <br>
                    Представительство в Москве:
                    ул. Академика Анохина, д.2, корп.1
                    <br>
                    <strong>Время визита согласуйте заранее. Телефон: +7 (965) 320-77-41</strong>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row margin-top-20">
        <div class="col-md-12">
            <p>
                <img src="<?= $this->theme->baseUrl;?>/web/images/footer-logo.png">
            </p>
            <p>
                © <span style="color: #fff">АНО</span>. Зарегистрированный товарный знак Модного Дома «АНО».
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="list-inline">
                <li><a href="http://www.vk.com/anomoda"><i class="fa fa-vk"></i></a></li>
                <li><a href="https://ok.ru/group/55276583518230"><i class="fa fa-odnoklassniki"></i></a></li>
                <li>
                    <a href="https://www.facebook.com/%D0%9C%D0%BE%D0%B4%D0%BD%D1%8B%D0%B9-%D0%B4%D0%BE%D0%BC-%D0%90%D0%9D%D0%9E-238414086571489/"><i
                                class="fa fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/modniydomano_official/"><i class="fa fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>