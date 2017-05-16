<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">
    ymaps.ready(init);
    var mapOmsk, 
        mapOmskPlacemark,
        mapMoscow,
        mapMoscowPlacemark;
        

    function init(){ 
        mapOmsk = new ymaps.Map("mapOmsk", {
            center: [54.9932,73.3564],
            zoom: 16,
            controls: ["zoomControl", "fullscreenControl"]
        }); 
		
		mapOmskPlacemark = new ymaps.Placemark([54.9936,73.3562], {}, {
			iconLayout: 'default#image',
			iconImageHref: "/app/templates/black/web/images/ANODotMap.png",
            iconImageSize: [170, 80],
            iconImageOffset: [-17, -86]
	});
	
	mapMoscow = new ymaps.Map("mapMoscow", {
            center: [55.669935,37.475809],
            zoom: 16,
            controls: ["zoomControl", "fullscreenControl"]
        }); 
        
		mapMoscowPlacemark = new ymaps.Placemark([55.669935,37.475809], {}, {
			iconLayout: 'default#image',
			iconImageHref: "/app/templates/black/web/images/ANODotMap.png",
            iconImageSize: [170, 80],
            iconImageOffset: [-17, -86]
	});
        mapOmsk.behaviors.disable('scrollZoom');
		mapMoscow.behaviors.disable('scrollZoom');
		
        mapOmsk.geoObjects.add(mapOmskPlacemark);
        mapMoscow.geoObjects.add(mapMoscowPlacemark);
        
    }
</script>

<p class="help-block">
	Осуществляем доставку женской одежды во все города России.
                            Всю информацию по франчайзингу можно найти в разделе Франчайзинг
</p>
<h2>
ПРЕДСТАВИТЕЛЬСТВО В ОМСКЕ:
</h2><address>
Время работы: с 9:00 до 18:00 (МСК + 3 часа)<br>
Рабочая неделя: понедельник-пятница<br>
Ждём Ваших звонков по телефу: 8 800 350-32-42<br>
E-mail:
<a href="mailto:mail@anomoda.ru">
mail@anomoda.ru
</a><br>
</address>
<div class="row">
<div class="col-md-6"><img src="<?= $this->theme->baseUrl;?>/web/images/millenium.jpg"/></div>
<div class="col-md-6"><div id="mapOmsk" style="width: 100%; height: 358px;"></div></div>
</div>
<h2>
ПРЕДСТАВИТЕЛЬСТВО В МОСКВЕ:
</h2><address>
ул. Академика Анохина, д.2, корп.1, (ст. метро «Юго-Западная»)<br>
Время работы: с 10:00 до 23:00 (перед визитом обязательно позвоните нам, чтобы мы Вас встретили в удобное для Вас время)<br>
Рабочая неделя: 7 дней в неделю<br>
Ждём Ваших звонков по телефону: +7 (965) 320-77-41<br>
E-mail:
<a href="mailto:ledi-vera@mail.ru">
ledi-vera@mail.ru
</a><br>
</address>
<div id="mapMoscow" style="width: 100%; height: 450px;"></div>
<p class="help-block bold">
	Описание проезда
</p>
<p class="text-justify">
	Станция метро «Юго-Западная», от метро 7-9 минут пешком или 2 остановки общественным транспортом. Перед визитом ОБЯЗАТЕЛЬНО созвонитесь с нами, чтобы мы были на месте и могли встретить Вас!
</p>
<p class="text-justify">
	Если добираться на метро, далее пешком:<br>
	Станция метро «Юго-Западная».<br>
	Выход из метро - последний вагон из центра.<br>
	Из стеклянных дверей выходите налево, затем снова налево по лестнице наверх. Выходите на поверхность и сразу направо, идёте вниз (проходите по тропинке справа от ТЦ «Звёздочка»). Переходите светофор по ходу движения и идёте дальше вдоль длинного зелёного забора справа от здания, похожего на "стеклянный айсберг". Переходите следующий светофор прямо по ходу движения возле супермаркета «Виктория». Как только перешли светофор, сразу поверните налево. Позади супермаркета «Виктория» находится жилой 25-этажный дом с голубыми стенами. Это и есть нужное Вам здание. Дом стоит сразу за «Викторией». Далее наберите наш номер телефона и мы Вас встретим, если Ваш визит заранее с нами согласован.
</p>
<p class="text-justify">
	Если добираться на метро, далее общественным транспортом - выход из метро первый вагон из центра, из стеклянных дверей налево и по лестнице снова налево. Остановка общественного транспорта непосредственно у выхода из метро. Маршрутка 162, автобусы 667, 227. Проехать нужно 2 остановки и выйти у супермаркета «Виктория». Наше здание (жилой 25-этажный дом с голубыми стенами) находится позади супермаркета. Далее наберите наш номер телефона и мы Вас встретим, если Ваш визит заранее с нами согласован.
</p>