<?php
/** @var Model_Content $contentModel */
$contentModel = Model::factory('Content');
?>
<div class="menu-scroll">
    <div class="menu-logo">
        <img src="/public/img/logo.png">
    </div>
    <ul>
        <li class="opened active menu-item">
            <a href="/" ><span class="menu-item-text">Главная</span></a>
        </li>
        <li class="menu-item">
            <a href="/catalog" ><span class="menu-item-text">Каталог товаров</span></a>
            <ul class="level-2">
                <?foreach ($contentModel->getPages(null, true) as $page) {?>
                    <li><a href="/page/<?=$page['slug'];?>" ><?=$page['name'];?></a></li>
                <?}?>
            </ul>
        </li>
        <li class="menu-item"><a href="/reviews" ><span class="menu-item-text">Отзывы о нас</span></a></li>
        <li class="menu-item"><a href="/contacts" ><span class="menu-item-text">Наш адрес</span></a></li>
    </ul>
</div>