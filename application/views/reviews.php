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
        <div class="layout layout_2_id_35">
            <h1 class="h1 widget-29 widget-type-h1 editorElement layer-type-widget">
                Отзывы о нас
            </h1>
            <article class="content-36 content widget-30 widget-type-content editorElement layer-type-widget">
                <div class="s3_board_tpl">
                    <article>
                        <div class="s3_comments">
                            <?foreach ($reviews as $review){?>
                            <dl class="s3_comments_item">
                                <dt class="s3_comment_head">
                                    <span class="s3_comment_author">
                                        <strong><?=$review['author'];?></strong>
                                    </span>
                                    <time class="s3_comment_date"><?=date('d.m.Y H:i', strtotime($review['date']));?></time>
                                </dt>
                                <dd class="s3_comment_content">
                                    <div class="s3_comment_text"><?=$review['content'];?></div>
                                </dd>
                            </dl>
                            <?}?>
                        </div>
                    </article>
                    <div class="s3_tpl_pagelist"></div>
                    <div>
                        <h2>Оставить сообщение</h2>
                        <div class="s3_form">
                            <div class="s3_form_item s3_form_item_type_text s3_form_item_required">
                                <div class="s3_form_field_title">
                                    <label for="s3_board_field_post_author">Имя:
                                        <span class="s3_required">*</span>
                                    </label>
                                </div>
                                <div class="s3_form_field_content">
                                    <input type="text" class="s3_form_field s3_form_field_type_text s3_form_field_required" id="s3_board_field_post_author" name="post_author" maxlength="100" size="32" value="">
                                </div>
                            </div>
                            <div class="s3_form_item s3_form_item_type_textarea s3_form_item_required">
                                <div class="s3_form_field_title">
                                    <label for="s3_board_field_post_content">Текст:
                                        <span class="s3_required">*</span>
                                    </label>
                                </div>
                                <div class="s3_form_field_content">
                                    <textarea class="s3_form_field s3_form_field_type_textarea s3_form_field_required" id="s3_board_field_post_content" name="post_content" rows="5" cols="60"></textarea>
                                </div>
                            </div>
                            <button class="s3_button_large" onclick="sendReview();">Отправить</button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>