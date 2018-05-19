@extends('layouts.index')

@section('content')
    <section class="section section--banner">
        <div class="banner owl-carousel owl-theme">
            <div class="banner__slide" style="background-image: url(http://tesoro-jewelry.com.ua/images/photos_main/11/photo.jpg);"></div>
            <div class="banner__slide" style="background-image: url(http://tesoro-jewelry.com.ua/images/photos_main/1/photo.jpg);"></div>
            <div class="banner__slide" style="background-image: url(http://tesoro-jewelry.com.ua/images/photos_main/18/photo.jpg);"></div>
        </div>
    </section>
    <section class="section section--product-slider">
        <div class="container-fluid">
            <div class="product-slider">
                <div class="product-slider__tabs">
                    <ul class="product-slider__tabs-list" data-tabgroup="tab-group">
                        <li><a href="#tab1" class="active">SALE</a></li>
                        <li><a href="#tab2">НОВИНКИ</a></li>
                        <li><a href="#tab3">ХИТЫ</a></li>
                        <li><a href="#tab4">мужские</a></li>
                    </ul>
                </div>
                <div id="tab-group" class="product-slider__tabgroup">
                    <div id="tab1" class="product-slider__tabgroup-item owl-carousel owl-theme">
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-slider__item">
                            <div class="product-slider__item-image">
                                <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                            </div>
                            <div class="product-slider__item-maininfo">
                                <h2 class="product-slider__item-ttl product-slider__item-ttl--hover">Серьги Misi <br>OR086480</h2>
                                <div class="product-slider__item-markers">
                                    <span class="action">акция</span>
                                    <span class="new">новинка</span>
                                    <span class="sale">скидка</span>
                                    <span class="hit">хит</span>
                                </div>
                                <p class="product-slider__item-maininfo-txt">Страна: Италия
                                    <br> Страна: Позолота
                                    <br> Материал: серебро
                                    <br> >925 | Втавки
                                    <br> Эмаль, фианиты</p>
                            </div>
                            <div class="product-slider__item-bottominfo">
                                <span class="product-slider__item-discount">-40%</span>
                                <h2 class="product-slider__item-ttl">Серьги Misi <br> OR086480</h2>
                                <h6 class="product-slider__item-price"> 12340 грн</h6>
                                <div class="product-slider__item-linkset">
                                    <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    <a class="product-slider__item-button" href="#">посмотреть</a>
                                    <a href="#"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="product-slider__tabgroup-item">2Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis at incidunt velit dolorum libero, voluptatibus reiciendis ut non quibusdam cum quae culpa hic dignissimos ipsa rerum, molestiae, omnis nam dicta! Autem, corporis.</div>
                    <div id="tab3" class="product-slider__tabgroup-item">3Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus, vel! Ea iusto necessitatibus odit numquam sit beatae quas rem. Et voluptates, consectetur dicta a nulla asperiores natus quia vitae nisi at voluptas. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, vitae!</div>
                    <div id="tab4" class="product-slider__tabgroup-item">4Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni blanditiis repudiandae quas, iste, ipsum placeat dolor laboriosam aperiam esse, suscipit sed, architecto est inventore recusandae quae vero aspernatur. Reprehenderit ut quidem, numquam!</div>
                </div>
            </div>
            <div class="simple-button">
                <a href="#">Развернуть все<i class="simple-button-ico--right fa fa-angle-down" aria-hidden="true"></i></a>
            </div>
        </div>
    </section>
    <section class="section section-promo">
        <div class="promo owl-carousel owl-theme">
            <a href="#" class="promo__item promo__item--large">
                <div class="promo__image"><img src="img/promo/gold.png" alt=""></div>
                <h6 class="promo__name">Золотые украшения</h6>
            </a>
            <a href="#" class="promo__item promo__item--large">
                <div class="promo__image"><img src="img/promo/silver.png" alt=""></div>
                <h6 class="promo__name">Cеребрянные украшения</h6>
            </a>
            <a href="#" class="promo__item promo__item--small">
                <div class="promo__image"><img src="img/promo/braslet.png" alt=""></div>
                <h6 class="promo__name">Браслеты</h6>
            </a>
            <a href="#" class="promo__item promo__item--small">
                <div class="promo__image"><img src="img/promo/nomination.png" alt=""></div>
                <h6 class="promo__name">Наборные браслеты <br> Nomination</h6>
            </a>
            <a href="#" class="promo__item promo__item--large">
                <div class="promo__image"><img src="img/promo/rings.png" alt=""></div>
                <h6 class="promo__name">Кольца</h6>
            </a>
            <a href="#" class="promo__item promo__item--large">
                <div class="promo__image"><img src="img/promo/ear.png" alt=""></div>
                <h6 class="promo__name">Cерьги</h6>
            </a>
            <a href="#" class="promo__item promo__item--large">
                <div class="promo__image"><img src="img/promo/mans.png" alt=""></div>
                <h6 class="promo__name">Мужские украшения</h6>
            </a>
            <a href="#" class="promo__item promo__item--large">
                <div class="promo__image"><img src="img/promo/bag.png" alt=""></div>
                <h6 class="promo__name">Cумки</h6>
            </a>
            <a href="#" class="promo__item promo__item--small">
                <div class="promo__image"><img src="img/promo/watch.png" alt=""></div>
                <h6 class="promo__name">Часы</h6>
            </a>
        </div>
    </section>
    <section class="section section--brands">
        <div class="container-fluid">
            <div class="brands owl-carousel owl-theme">
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/12/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/1/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/8/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/1/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/7/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/2/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/3/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/4/photo.jpg" alt="">
                    </div>
                </div>
                <div class="brands__item">
                    <div class="brands__image">
                        <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/prz/9/photo.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="section section--advantage">
        <div class="container-fluid">
            <h2 class="advantage__mainttl"><span>Tesoro Jewelry</span> — официальный интернет магзагин мировых ювелирных брендов</h2>
            <div class="row advantage owl-carousel owl-theme">
                <div class="col-4 col-lg-2 advantage__item">

                    <div class="advantage__image">
                        <img src="img/advantage/advantage1.png" alt="" class="img-responsive"></div>
                    <h3 class="advantage__ttl">Официальная точка продаж</h3>
                    <p class="advantage__info">Мы официальные представители лучших ювелирных брендов Европы и мира</p>

                </div>
                <div class="col-4 col-lg-2 advantage__item">

                    <div class="advantage__image">
                        <img src="img/advantage/advantage2.png" alt="" class="img-responsive"></div>
                    <h3 class="advantage__ttl">Продукция в наличии</h3>
                    <p class="advantage__info">Мы официальные представители лучших ювелирных брендов Европы и мира</p>

                </div>
                <div class="col-4 col-lg-2 advantage__item">

                    <div class="advantage__image">
                        <img src="img/advantage/advantage3.png" alt="" class="img-responsive"></div>
                    <h3 class="advantage__ttl">Работаем под заказ</h3>
                    <p class="advantage__info">Мы официальные представители лучших ювелирных брендов Европы и мира</p>

                </div>
                <div class="col-4 col-lg-2 advantage__item">

                    <div class="advantage__image">
                        <img src="img/advantage/advantage4.png" alt="" class="img-responsive"></div>
                    <h3 class="advantage__ttl">Возврат и обмен</h3>
                    <p class="advantage__info">Мы официальные представители лучших ювелирных брендов Европы и мира</p>

                </div>
                <div class="col-4 col-lg-2 advantage__item">

                    <div class="advantage__image">
                        <img src="img/advantage/advantage5.png" alt="" class="img-responsive"></div>
                    <h3 class="advantage__ttl">Бесплатная доставка</h3>
                    <p class="advantage__info">Мы официальные представители лучших ювелирных брендов Европы и мира</p>

                </div>
                <div class="col-4 col-lg-2 advantage__item">

                    <div class="advantage__image">
                        <img src="img/advantage/advantage6.png" alt="" class="img-responsive"></div>
                    <h3 class="advantage__ttl">Удобный способ оплаты</h3>
                    <p class="advantage__info">Мы официальные представители лучших ювелирных брендов Европы и мира</p>

                </div>
            </div>
        </div>
    </section>
    <section class="section section--instagram">
        <div class="container-fluid">
            <h2 class="instagram__mainttl">Instagram #tesoro_jewelry</h2>
            <div class="instagram owl-carousel owl-theme">
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
                <a href="#" class="instagram__item" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);">
                    <div class="instagram__overlay"></div>
                </a>
            </div>
        </div>
    </section>
    <section class="section section--news-review">
        <div class="container-fluid">
            <div class="row">
                <div class="section--news-review__separator"><img \ src="img/news-review-separator.png" alt=""></div>
                <div class="col-md-6">
                    <h2 class="news__ttl">Новости и статьи</h2>
                    <div class="news owl-carousel owl-theme">
                        <div class="news__desktop-item">
                            <a href="#" class="news__item">
                                <div class="news__image" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);"></div>
                                <div class="news__info">
                                    <span class="news__date">20 янв</span>
                                    <p class="news__txt">Итальянский ювелирный бренд Roberto Bravo теперь официально у нас! событие </p>
                                    <span class="news__type">событие</span>
                                </div>
                            </a>
                            <a href="#" class="news__item">
                                <div class="news__image" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);"></div>
                                <div class="news__info">
                                    <span class="news__date">20 янв</span>
                                    <p class="news__txt">Итальянский ювелирный бренд Roberto Bravo теперь официально у нас! событие </p>
                                    <span class="news__type">событие</span>
                                </div>
                            </a>
                        </div>
                        <div class="news__desktop-item">
                            <a href="#" class="news__item">
                                <div class="news__image" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);"></div>
                                <div class="news__info">
                                    <span class="news__date">20 янв</span>
                                    <p class="news__txt">Итальянский ювелирный бренд Roberto Bravo теперь официально у нас! событие </p>
                                    <span class="news__type">событие</span>
                                </div>
                            </a>
                            <a href="#" class="news__item">
                                <div class="news__image" style="background-image: url(https://image.freepik.com/free-photo/hair-style-street-fashion-beautiful-girl_1139-844.jpg);"></div>
                                <div class="news__info">
                                    <span class="news__date">20 янв</span>
                                    <p class="news__txt">Итальянский ювелирный бренд Roberto Bravo теперь официально у нас! событие </p>
                                    <span class="news__type">событие</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="review__ttl">Отзывы <a href="#">Оставить отзыв</a></h2>
                    <div class="review owl-carousel owl-theme">
                        <div class="review__desktop-item">
                            <div class="review__item">
                                <div class="review__image">
                                    <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                                    <p class="review__name">Сумка Graziella LG0287TB0LG0287TB0
                                    </p>
                                </div>
                                <div class="review__info">
                                    <p class="review__txt">Сумка очень удобная, муж брал мне в подарок, но вот с цветом не угадал, просила взять под платье, а не пальто... </p>
                                    <div class="review__info-bar">
                                        <h6 class="review__info-name">Юля</h6>
                                        <div class="review__info-rate"><i class="active"></i><i class="active"></i><i class="active"></i><i></i><i></i> </div>
                                        <div class="review__info-button"><a href="#">подробнее</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="review__item">
                                <div class="review__image">
                                    <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                                    <p class="review__name">Сумка Graziella LG0287TB0LG0287TB0
                                    </p>
                                </div>
                                <div class="review__info">
                                    <p class="review__txt">Сумка очень удобная, муж брал мне в подарок, но вот с цветом не угадал, просила взять под платье, а не пальто...</p>
                                    <div class="review__info-bar">
                                        <h6 class="review__info-name">Юля</h6>
                                        <div class="review__info-rate"><i class="active"></i><i class="active"></i><i class="active"></i><i></i><i></i> </div>
                                        <div class="review__info-button"><a href="#">подробнее</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review__desktop-item">
                            <div class="review__item">
                                <div class="review__image">
                                    <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                                    <p class="review__name">Сумка Graziella LG0287TB0LG0287TB0
                                    </p>
                                </div>
                                <div class="review__info">
                                    <p class="review__txt">Сумка очень удобная, муж брал мне в подарок, но вот с цветом не угадал, просила взять под платье, а не пальто... </p>
                                    <div class="review__info-bar">
                                        <h6 class="review__info-name">Юля</h6>
                                        <div class="review__info-rate"><i class="active"></i><i class="active"></i><i class="active"></i><i></i><i></i> </div>
                                        <div class="review__info-button"><a href="#">подробнее</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="review__item">
                                <div class="review__image">
                                    <img class="img-responsive" src="http://tesoro-jewelry.com.ua/images/products/1530/thumb500_6fc3a0cf-0784-11e5-8f38-c860006e2dd4%7B0%7D.jpg" alt="">
                                    <p class="review__name">Сумка Graziella LG0287TB0LG0287TB0
                                    </p>
                                </div>
                                <div class="review__info">
                                    <p class="review__txt">Сумка очень удобная, муж брал мне в подарок, но вот с цветом не угадал, просила взять под платье, а не пальто...</p>
                                    <div class="review__info-bar">
                                        <h6 class="review__info-name">Юля</h6>
                                        <div class="review__info-rate"><i class="active"></i><i class="active"></i><i class="active"></i><i></i><i></i> </div>
                                        <div class="review__info-button"><a href="#">подробнее</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section--about">
        <div class="container-fluid">
            <div class="about">
                <h2 class="about__ttl">О Тесоро</h2>
                <p>Tesoro-jewelry.com.ua – это интернет-магазин брендовых ювелирных украшений, сумок, часов и аксессуаров из Италии, Чехии, Монако, Франция, Турции, Австрии и Украины, который является частью брендовой сети бутиков Тесоро, открытых в Одессе, а так же наших партнеров, чьи бутики находятся в Киеве и Львове.
                    <br>
                    <br>Наша сеть является официальной точкой продаж ведущих мировых брендов ювелирных украшений, сумок, часов и аксессуаров, таких как 935 BY ROBERTO BRAVO (Италия), ROBERTO BRAVO (Италия), MISIS (Италия), NOMINATION (Италия), GRAZIELLA (Италия), ADAMI&MARTUCCI (Италия), APM MONACO (Франция), RIPANI (Италия), FACEBEG (Чехия), TERGAN (Турция), DOPPLER (Австрия), ZEADES( Монако), DNKY( США), ARMANI (Италия) и другие, завоевавшие огромную популярность и любовь у самых требовательных модниц мира...</p>
            </div>
        </div>
    </section>
    <section class="section section--share">
        <div class="share">
            <div class="container-fluid">
                <div class="share__inner">
                    <div class="row">
                        <div class="col-md-3">
                            <h2 class="share__ttl">Дарим* -15% на первую покупку</h2>
                            <p class="share__subttl">за подписку на наши новости</p>
                        </div>
                        <div class="col-md-3">
                            <div class="share__img"><img class="img-responsive" src="img/share-ring.png" alt=""></div>
                        </div>
                        <div class="col-md-3">
                            <form action="" class="share__form">
                                <input placeholder="Ваше имя" class="share__name"></input>
                                <input placeholder="Ваша электронная почта" class="share__email"></input>
                                <span>*Предложение не суммируется с другими скидками</span>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <div class="share__social">
                                <div class="share__button"><a href="#">ПОДПИСАТЬСЯ</a></div>
                                <p>Поделиться</p>
                                <div class="share__links">
                                    <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()