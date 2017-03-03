<div class="layout layout_center not-columned layout_center_2_id_3_1" >
    <div class="blocklist blocklist-13 widget-11 horizontal_mode widget-type-block_list layer-type-widget">
        <div class="header">
            <div class="header_text">Корзина</div>
        </div>
        <div class="body">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well form-group">
                <table class="table table-bordered cart-table">
                    <thead>
                    <tr>
                        <td></td>
                        <td>Товар</td>
                        <td>Цена</td>
                        <td>Кол-во</td>
                        <td>Сумма</td>
                    </tr>
                    </thead>
                    <tbody>

                    <?
                    $allPrice = 0;

                    foreach($cart as $cartData) {
                        $allPrice += $cartData['price'] * $cartData['num'];
                        ?>
                        <tr class="table-row-<?=$cartData['id'];?>" id="tableRow_<?=$cartData['id'];?>" data-cart-id="<?=$cartData['id'];?>">
                            <td class="text-center">
                                <button class="btn btn-danger btn-xs remove-position">x</button>
                            </td>
                            <td class="text-left item-name">
                                <?=$cartData['name'];?>
                            </td>
                            <td class="item-price">
                                <span><?=$cartData['price'];?></span>
                            </td>
                            <td class="item-num text-center">
                                <?=$cartData['num'];?>
                            </td>
                            <td class="item-price">
                                <span class="position-sum" id="positionSum_<?=$cartData['id'];?>"><?=$cartData['price']*$cartData['num'];?></span>
                            </td>
                        </tr>
                    <?}?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">
                            Товаров в корзине на сумму:
                        </td>
                        <td class="item-price">
                            <span id="allPrice" class="all-price"><?=$allPrice;?></span>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="cart-order">
            <div class="form-group cart-order-title row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                В приведенной ниже форме оставьте, пожалуйста, Ваше имя и телефон,
                по которым наш менеджер сможет связаться с вами для уточнения условий заказа
                </div>
            </div>
            <div id="order-form" class="row form-group">
                <div class="delivery-type-form" id="deliveryTypeForm">
                    <div class="quest-client-order-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="pull-left">Ваше имя <span>*</span> :</label>
                        <input class="form-control cart-customer-field" id="name" name="name" type="text" placeholder="Ваше имя" value="">
                    </div>
                    <div class="quest-client-order-form col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="pull-left">Телефон <span>*</span> :</label>
                        <input class="form-control cart-customer-field" id="phone" name="phone" type="text" placeholder="Телефон" value="">
                    </div>
                </div>
                <input type="hidden" name="newOrder" value="1">
            </div>
            <?if (!empty($cart)) {?>
                <div class="submit-order-btn-field">
                    <button class="btn btn-danger submit-order-btn" type="button">Оформить заказ</button>
                </div>
            <?}?>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAlert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-success">
                    <strong>Заказ успешно отправлен!</strong> Мы свяжемся с вами в ближайшее время.
                </div>
            </div>
        </div>
    </div>
</div>