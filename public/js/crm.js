$(document).ready(function () {
    $('.add-need-part').click(function () {
        addNeedPart();
    });
    $('.order-data #inputBrand').typeahead({source:[
        'AUDI','BMW','CHEVROLET','FORD','HONDA','ISUZU','KIA','LEXUS','MAZDA','MERCEDES-BENZ',
        'MITSUBISHI','NISSAN','OPEL','RENAULT','SUBARU','SUZUKI','TOYOTA','VOLKSVAGEN'
    ]});
    $('#inputLeadTime').datetimepicker({locale: 'ru'});
    $('#firstDate').datetimepicker({locale: 'ru',format: 'DD.MM.YYYY'});
    $('#lastDate').datetimepicker({locale: 'ru',format: 'DD.MM.YYYY'});
});
function addNeedPart() {
    $('#needParts').append(
        '<div class="form-group col-lg-12">' +
        '<div class="col-lg-9">' +
            '<input type="text" class="form-control" name="partsName[]" id="needPartsName1" placeholder="Название">' +
        '</div>' +
        '<div class="col-lg-3">' +
            '<input type="text" class="form-control" name="partsQuantity[]" id="needPartsQuantity1" placeholder="0">' +
        '</div>' +
        '</div>'
    );
}
function searchOrderSpareOffer(id, article) {$.ajax({url:'/ajax/search_order_spare_offer', type: 'POST', async: true, data: {article:article}}).done(function (data) {writeSearchOrderSpareOfferResult(id, data);});}
function writeSearchOrderSpareOfferResult(id, jsonData) {
    var data = JSON.parse(jsonData);

    $('#searchModalBody .search-spares-table tbody').html('');

    for (i = 0;i < data.length;i++) {
        $('#searchModalBody .search-spares-table tbody').append(
            '<tr>' +
            '<td>' +
                data[i].supplier_name +
            '</td>' +
            '<td>' +
                data[i].brand +
            '</td>' +
            '<td>' +
                data[i].article +
            '</td>' +
            '<td>' +
                data[i].price +
            '</td>' +
            '<td>' +
                data[i].quantity +
            '</td>' +
            '<td class="text-center">' +
                '<button class="btn btn-default" onclick="setOrderSpareBySearch(' + data[i].id + ', ' + id + ');"><span class="fa fa-check-circle"></span></button>' +
            '</td>' +
            '</tr>'
        );
    }

    $('#searchModal').modal('toggle');
}
function setOrderSpareBySearch(itemId, id) {$.ajax({url:'/ajax/set_order_spare_by_search', type: 'POST', async: true, data: {id:id, itemId:itemId}}).done(function () {location.reload();});}
function searchOrderByNumber() {$.ajax({url:'/ajax/search_order_by_number', type: 'POST', async: true, data: {id:$('#searchOrder').val()}}).done(function (response) {if(response == 0) {alert('Заказ не найден!');}else{document.location='/crm/order/' + response;}});}
function addSpareToOrderFromSearch(itemId) {if($('#searchOfferForm #orderId').val() == '') {alert('Не указан заказ!'); return false;}$.ajax({url:'/ajax/add_spare_to_order_from_search', type: 'POST', async: true, data: {orderId:$('#searchOfferForm #orderId').val(), itemId: itemId}}).done(function (result) {if(result.indexOf('success') != -1){alert('Товар удачно добавлен в заказ!');}else{alert('Ошибка добавления товара в заказ!');}});}
function searchOrderSpare(orderId, itemId) {if(orderId == '') {alert('Не указан заказ!'); return false;}$.ajax({url:'/ajax/search_order_spare', type: 'POST', async: true, data: {orderId:orderId}}).done(function (data) {writeOrderSpare(itemId, data);});}
function writeExchangeItem(itemId) {$('#exchangeItem').html($('#searchItemRow' + itemId + ' .item-brand').text() + ' / ' + $('#searchItemRow' + itemId + ' .item-article').text());}
function writeOrderSpare(itemId, jsonData) {
    writeExchangeItem(itemId);
    var data = JSON.parse(jsonData);

    $('#setSpareModalBody .set-spares-table tbody').html('');

    for (i = 0;i < data.length;i++) {
        $('#setSpareModalBody .set-spares-table tbody').append(
            '<tr>' +
            '<td>' +
            data[i].supplier_name +
            '</td>' +
            '<td>' +
            data[i].name +
            '</td>' +
            '<td>' +
            data[i].brand +
            '</td>' +
            '<td>' +
            data[i].article +
            '</td>' +
            '<td>' +
            data[i].offer_price +
            '</td>' +
            '<td>' +
            data[i].quantity +
            '</td>' +
            '<td class="text-center">' +
            '<button class="btn btn-default" onclick="setOrderSpareBySearch(' + itemId + ', ' + data[i].id + ');"><span class="fa fa-exchange"></span></button>' +
            '</td>' +
            '</tr>'
        );
    }

    $('#setSpareModal').modal('toggle');
}