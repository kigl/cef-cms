<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo SITE_CODING ?>">
    <meta charset="<?php echo SITE_CODING ?>">
    <title><?php Core_Page::instance()->showTitle() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="description" content="<?php Core_Page::instance()->showDescription() ?>">
    <meta name="keywords" content="<?php Core_Page::instance()->showKeywords() ?>">
    <meta name="author" content="HostCMS">

    <link type="text/css" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700&subset=latin,cyrillic-ext"
          rel="stylesheet">
    <link type="text/css"
          href="http://fonts.googleapis.com/css?family=Roboto:400,700,300,400italic,700italic&subset=latin,cyrillic-ext"
          rel="stylesheet">

    <!-- Stylesheets -->
    <?php
    Core_Page::instance()
        ->prependCss('/bootstrap/bootstrap3/css/bootstrap.min.css')
        ->css('/bootstrap/css/font-awesome.min.css')
        ->css('/hostcmsfiles/jquery/photobox/photobox.css')
        ->css('/hostcmsfiles/jquery/slider/jquery-ui.css')
        ->css('/hostcmsfiles/slippry/dist/slippry.css')
        ->showCss();
    ?>

    <?php Core_Browser::check() ?>

    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="alternate" type="application/rss+xml" title="RSS Feed" href="/news/rss/">

    <?php
    Core_Page::instance()
        // jQuery
        ->js('/hostcmsfiles/jquery/jquery.min.js')
        ->js('/hostcmsfiles/jquery/slider/jquery-ui.js')
        // Validate
        ->js('/hostcmsfiles/jquery/jquery.validate.min.js')
        // LightBox
        ->js('/hostcmsfiles/jquery/lightbox/js/jquery.lightbox.js')
        //ElevateZoom
        ->js('/hostcmsfiles/jquery/jquery.elevatezoom-3.0.8.min.js')
        // HostCMS
        ->js('/templates/template1/hostcms.js')
        ->js('/templates/template1/hostcms_adaptive.js')
        ->js('/hostcmsfiles/main.js')
        // BBcode
        ->js('/hostcmsfiles/jquery/bbedit/jquery.bbedit.js')
        // Stars
        ->js('/hostcmsfiles/jquery/stars/jquery.ui.core.min.js')
        ->js('/hostcmsfiles/jquery/stars/jquery.ui.stars.js')
        // jQuery.Autocomplete
        ->js('/hostcmsfiles/jquery/jquery.autocomplete.min.js')
        //photobox
        ->js('/hostcmsfiles/jquery/photobox/jquery.photobox.js')
        ->js('/bootstrap/js/bootstrap.min.js')
        ->js('/hostcmsfiles/slippry/dist/slippry.min.js')
        ->showJs();
    ?>
    <script type='text/javascript'>
        (function () {
            var widget_id = 'muuWQCTOD6';
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = '//code.jivosite.com/script/widget/' + widget_id;
            var ss = document.getElementsByTagName('script')[0];
            ss.parentNode.insertBefore(s, ss);
        })();
    </script>
    <script>
        $(function () {
            var demo1 = $("#main_slider").slippry({
                // transition: 'fade',
                useCSS: true,
                // speed: 1000,
                // pause: 3000,
                // auto: true,
                // preload: 'visible',
                // autoHover: false
            });

            $('.stop').click(function () {
                demo1.stopAuto();
            });

            $('.start').click(function () {
                demo1.startAuto();
            });

            $('.prev').click(function () {
                demo1.goToPrevSlide();
                return false;
            });
            $('.next').click(function () {
                demo1.goToNextSlide();
                return false;
            });
            $('.reset').click(function () {
                demo1.destroySlider();
                return false;
            });
            $('.reload').click(function () {
                demo1.reloadSlider();
                return false;
            });
            $('.init').click(function () {
                demo1 = $("#main_slider").slippry();
                return false;
            });

            $("#zoom").elevateZoom({
                gallery: 'gallery',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: true,
                loadingIcon: '/hostcmsfiles/images/spinner.gif',
                responsive: true
            });

            $('.stars').stars({
                inputType: "select", disableValue: false
            });

            $(".slider").slider({
                range: true,
                //step: 1000,
                slide: function (event, ui) {
                    $(this).prev().find("input[name$='_from']").val(ui.values[0]);
                    $(this).prev().find("input[name$='_to']").val(ui.values[1]);
                },
                create: function (event, ui) {
                    var min_value_original = parseInt($(this).prev().find("input[name$='_from_original']").val()),
                        max_value_original = parseInt($(this).prev().find("input[name$='_to_original']").val()),
                        min_value = parseInt($(this).prev().find("input[name$='_from']").val()),
                        max_value = parseInt($(this).prev().find("input[name$='_to']").val());

                    $(this).slider({
                        min: min_value_original,
                        max: max_value_original,
                        values: [min_value, max_value]
                    });
                }
            });

            //jQuery.Autocomplete selectors
            $('#search').autocomplete({
                serviceUrl: '/search/?autocomplete=1',
                delimiter: ',',
                maxHeight: 200,
                width: 300,
                deferRequestBy: 300,
                appendTo: '#search_mini_form',
                onSelect: function (suggestion) {
                    $(this).closest("form").submit();
                }
            });

            // Little cart
            var delay = 500, setTimeoutConst;
            $('.little-cart').hover(function () {
                clearTimeout(setTimeoutConst);
                $(this).addClass('cart-active').find('.more-cart-info').stop().slideDown();
            }, function () {
                var littleCart = $(this);
                setTimeoutConst = setTimeout(function () {
                    littleCart.removeClass('cart-active').find('.more-cart-info').stop().slideUp();
                }, delay);
            });

            $('#gallery').photobox('a', {time: 0});
        });
    </script>
</head>
<body class="pageBody">
<!-- Header starts -->
<header>
    <div class="bg-color1">
        <div class="wrapper container-fluid">
            <div class="header-top">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pull-left">
                            <ul class="list-inline header-link">
                                <li><a href="/order-samples"><i class="fa fa-file-o"></i>Заказать образцы</a></li>
                                <li><a href="/callback"><i class="fa fa-phone"></i>Заказать обратный звонок</a></li>
                            </ul>
                        </div>
                        <div class="quick-access">
                            <ul class="links list-unstyled">
                                <li class="first">
                                    <?php
                                    if (Core::moduleIsActive('siteuser')) {
                                        $oSiteuser = Core_Entity::factory('Siteuser')->getCurrent();

                                        ?><a title="Войти" href="/users/">
                                        <i class="glyphicon glyphicon-log-in"></i>
                                        <?php
                                        if (is_null($oSiteuser)) {
                                            ?>Войти<?php
                                        } else {
                                            ?>Здравствуйте, <?php echo htmlspecialchars($oSiteuser->login);
                                        }
                                        ?></a>
                                        <?php if (is_null($oSiteuser)) { ?>
                                            <a href="/users/registration">
                                                <i class="glyphicon glyphicon-user"></i>
                                                Регистрация</a>
                                        <?php } ?>
                                        <?php
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <div class="pull-right margin-right-50">
                            <i class="glyphicon glyphicon-phone-alt"></i>&nbsp;(812) 676-76-59; (3812) 775-775; 775-565
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper container-fluid">
        <div class="header-other">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 text-center">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="/" title="HostCMS"><img src="/images/theme/omtex/logo.png"></a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-5">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            // Если модуль поиска доступен
                            if (Core::moduleIsActive('search')) {
                                ?>
                                <div class="header-search">
                                    <form id="search_mini_form" method="get" action="/search/">
                                        <div class="form-search">
                                            <i class="glyphicon glyphicon-search"
                                               onclick="$(this).closest('form').submit();"></i>
                                            <input id="search" type="text" name="text" placeholder="Поиск">
                                        </div>
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="little-cart">
                        <?php
                        if (Core::moduleIsActive('shop')) {
                            // Краткая корзина
                            $Shop_Cart_Controller_Show = new Shop_Cart_Controller_Show(
                                Core_Entity::factory('Shop', 13)
                            );
                            $Shop_Cart_Controller_Show
                                ->xsl(
                                    Core_Entity::factory('Xsl')->getByName('МагазинКорзинаКраткаяСайт13')
                                )
                                ->couponText(isset($_SESSION) ? Core_Array::get($_SESSION, 'coupon_text') : '')
                                ->itemsPropertiesList(false)
                                ->show();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
// Menu
$Structure_Controller_Show = new Structure_Controller_Show(
    Core_Entity::factory('Site', CURRENT_SITE));

$Structure_Controller_Show->xsl(
    Core_Entity::factory('Xsl')->getByName('ВерхнееМенюСайт13')
)
    ->menu(13);
//->show();
?>


<div class="wrapper container-fluid content">
    <?php
    Core_Page::instance()->execute();
    ?>
</div>


<footer class="bg-color1">
    <div class="footer-container">
        <div class="wrapper container-fluid">
            <div class="row">
                <div class="col-md-3 footer-social">
                    <ul class="list-unstyled list-inline">
                        <li><a href="https://vk.com/tkani_nitki"><i class="fa fa-vk"></i></a></li>
                        <li><a href="http://ok.ru/omtex?st._aid=ExternalGroupWidget_OpenGroup"><i
                                        class="fa fa-odnoklassniki"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <?php
                    // Menu
                    $Structure_Controller_Show = new Structure_Controller_Show(
                        Core_Entity::factory('Site', CURRENT_SITE));

                    $Structure_Controller_Show->xsl(
                        Core_Entity::factory('Xsl')->getByName('ФутерМенюСайт13')
                    )
                        ->menu(22)
                        ->show();
                    ?>
                    <?php
                    // Нижнее меню
                    $Structure_Controller_Show = new Structure_Controller_Show(
                        Core_Entity::factory('Site', 13));

                    $Structure_Controller_Show
                        ->xsl(Core_Entity::factory('Xsl')
                            ->getByName('НижнееМенюСайт13'));
                    //->show();
                    ?>
                </div>
                <div class="col-md-3">
                    <?php
                    // Menu
                    $Structure_Controller_Show = new Structure_Controller_Show(
                        Core_Entity::factory('Site', CURRENT_SITE));

                    $Structure_Controller_Show->xsl(
                        Core_Entity::factory('Xsl')->getByName('ФутерМеню2Сайт13')
                    )
                        ->menu(23)
                        ->show();
                    ?>
                </div>
                <div class="col-md-3">
                    <div class="h4">КОНТАКТНАЯ ИНФОРМАЦИЯ</div>
                    <ul class="list-unstyled">
                        <li>Адрес: пр. Академика Королева, 26, 644012, г.Омск</li>
                        <li>Телефон: +7 (3812) 775-775, 775-515, 775-545</li>
                        <li>Электронная почта: tkani@omtexn.ru</li>
                    </ul>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="footer-copyright">
                        <p class="text-center">&copy;&nbsp; Купить ткани, нитки и швейную фурнитуру «ОМТЕКС»</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-68484916-1', 'auto');
    ga('send', 'pageview');

</script>
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function () {
            try {
                w.yaCounter14974111 = new Ya.Metrika({
                    id: 14974111,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true,
                    webvisor: true,
                    trackHash: true
                });
            } catch (e) {
            }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
</body>
</html>