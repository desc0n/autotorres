<div class="layout layout_center not-columned layout_center_2_id_3_1" >
    <div class="layout columned columns-2 layout_2_id_34" >
        <div class="layout column layout_34" >
            <div class="widget-28 popup menu-34 wm-widget-menu vertical widget-type-menu_vertical editorElement layer-type-widget">
                <div class="menu-button">
                    Меню
                </div>
                <div class="menu-scroll">
                    <?=View::factory('left_page_menu');?>
                </div>
            </div>
        </div>
        <div class="layout layout_2_id_35" >
            <h1 class="h1 widget-29 widget-type-h1 editorElement layer-type-widget">
                <?=$title;?>
            </h1>
            <article class="content-36 content widget-30 widget-type-content editorElement layer-type-widget">
                <?=$content;?>
            </article>
        </div>
    </div>
</div>