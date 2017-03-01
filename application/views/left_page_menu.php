<?php
/** @var Model_Content $contentModel */
$contentModel = Model::factory('Content');
?>
<ul>
    <?foreach ($contentModel->getPages(null, true) as $page) {?>
        <?$activeClass = $page['slug'] === $rootPage ? 'opened active' : null;?>
    <li class="<?=$activeClass;?> menu-item">
        <a href="/page/<?=$page['slug'];?>" ><span class="menu-item-text"><?=$page['name'];?></span></a>
    </li>
    <?}?>
</ul>