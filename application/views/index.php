<div class="layout layout_center not-columned layout_center_2_id_3_1" >
<!--    <div class="widget-10 slider-12 slider widget-type-slider editorElement layer-type-widget" data-setting-pause="4000"-->
<!--         data-setting-mode="horizontal"-->
<!--         data-setting-auto="1"-->
<!--         data-setting-controls="1"-->
<!--         data-setting-pager=""-->
<!--         data-setting-pager_selector=".slider-12 .slider-pager"-->
<!--         data-setting-prev_selector=".slider-12 .slider-prev"-->
<!--         data-setting-next_selector=".slider-12 .slider-next"-->
<!--         data-setting-prev_text=""-->
<!--         data-setting-next_text="">-->
<!--        <div class="slider-inner">-->
<!--            <div class="slider-item-1 slider-item" data-src="/public/img/54407297.jpg">-->
<!--                <div  class="text-slider">-->
<!--                    <div class="text-slider-wp">-->
<!--                        <div class="block-title"><a href="/skidki">Скидка на установку радиатора</a></div>-->
<!--                        <div class="block-body">-->
<!--                            <div><p>Только в этом месяце, заказав радиатор, вы получаете скидку на его установку в размере 15%</p></div>-->
<!--                        </div>-->
<!--                        <div class="block-more">-->
<!--                            <a href="/skidki">подробнее</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <a href="/skidki"></a>-->
<!--            </div>-->
<!--            <div class="slider-item-2 slider-item" data-src="/public/img/54395762.jpg">-->
<!--                <div  class="text-slider">-->
<!--                    <div class="text-slider-wp">-->
<!--                        <div class="block-title"><a href="/skidki">Скидка на установку аккамулятора</a></div>-->
<!--                        <div class="block-body">-->
<!--                            <div><p>Только в этом месяце, заказав аккумулятор, вы получаете скидку на его установку в размере 15%</p></div>-->
<!--                        </div>-->
<!--                        <div class="block-more">-->
<!--                            <a href="/skidki">подробнее</a>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <a href="/skidki"></a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="slider-controls">-->
<!--            <span class="slider-prev"></span>-->
<!--            <span class="slider-next"></span>-->
<!--        </div>-->
<!--    </div>-->
    <div class="blocklist blocklist-13 widget-11 horizontal_mode widget-type-block_list editorElement layer-type-widget">
        <div class="header">
            <div class="header_text">Поиск</div>
        </div>
        <div class="body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well form-group">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9">
                            <input type="text" class="form-control" name="article" value="<?=$article;?>" placeholder="Артикул">
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                            <button class="btn btn-primary">Поиск</button>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-bordered search-spares-table">
                <thead>
                <tr>
                    <th>Бренд</th>
                    <th>Артикул</th>
                    <th>Цена</th>
                    <th>Наличие</th>
                    <th class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                <?foreach ($itemsList as $item){?>
                    <tr id="searchItemRow<?=$item['id'];?>">
                        <td class="item-brand"><?=$item['brand'];?></td>
                        <td class="item-article"><?=$item['article'];?></td>
                        <td><?=$item['offer_price'];?></td>
                        <td><?=$item['quantity'];?></td>
                        <td class="text-center">
                            <button class="btn btn-default" onclick="addToCart(<?=$item['id'];?>)" title="Добавить в корзину">
                                <span class="fa fa-shopping-cart"></span>
                            </button>
                        </td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="editorElement layer-type-block ui-droppable block-4"  data-responsive-tablet_landscape-changed="margin-top;padding-top;padding-bottom;" data-responsive-tablet_portrait-changed="margin-top;text-transform;padding-top;padding-bottom;" data-responsive-mobile_landscape-changed="padding-top;margin-top;padding-bottom;" data-responsive-mobile_portrait-changed="margin-top;padding-top;padding-bottom;">
    <div class="layout layout_center not-columned layout_22_id_14" >
        <h1 class="h1 widget-12 widget-type-h1 editorElement layer-type-widget">
            Главная
        </h1>
        <article class="content-15 content widget-13 widget-type-content editorElement layer-type-widget">
            <h2 style="text-align: center;">&nbsp;<strong style="text-align: center;">Добро пожаловать на наш сайт!</strong></h2>
            <p style="text-align: justify;">Наша компания предлагает владельцам иномарок запчасти и аксессуары к любому авто. Большое количество имеющихся в наличии зап.частей гарантия того, что,&nbsp;вы обязательно найдете у нас подходящую запасную часть. Если же для ремонта или проведения технического обслуживания вашего автомобиля потребуются индивидуальные компоненты, то у нас вы можете их заказать. В этой категории мы можем предложить большой ассортимент наименований.</p>
            <p style="text-align: justify;">В наших каталогах вы можете найти как расходные детали и мелкие крепежные элементы: фильтры, прокладки, болты, шланги, подшипники и т.д., так и крупные узлы в сборе: амортизационные стойки, двигатель и пр.</p>
            <p style="text-align: justify;">Мы предоставляем только надежные запчасти для иномарок от ведущих &nbsp;производителей, которые имеют соответствующие сертификаты. При этом высоким качеством по европейским стандартам отличаются как оригинальные автозапчасти, так и предлагаемые нами аналоги.</p>
        </article>
    </div>
</div>
<!--<div class="layout layout_center not-columned layout_center_2_id_3_3" >-->
<!--    <div class="horizontal_block-16 widget-14 widget-type-block_horizontal editorElement layer-type-widget">-->
<!--        <div class="header"></div>-->
<!--        <div class="body">-->
<!--            <div class="figure">-->
<!--                <div class="image">-->
<!--                    <a href="/spetspredlozheniye"><img src="/public/img/18229502.jpg" alt=""></a>					</div>-->
<!--            </div>-->
<!--            <div class="detail">-->
<!--                <div class="title">Спецпредложение</div>-->
<!--                <div class="text"><p>Только в этом месяце, вы можете заказать у нас запчасти со скидкой 15%.</p></div>-->
<!--                <div class="more"><a href="/spetspredlozheniye">подробнее</a></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->