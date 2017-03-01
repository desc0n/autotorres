function sendReview() {
    var author = $('#s3_board_field_post_author').val();
    var content = $('#s3_board_field_post_content').val();

    if (author == '') {alert('Укажите имя!');return false;}
    if (content == '') {alert('Введите текст отзыва!');return false;}

    $.post('/ajax/send_review', {'author':author, 'content' : content}, function (data) {if ($.trim(data) == 'success') alert('Ваш отзыв успешно отправлен!'); else alert('Ошибка отправки запроса.');});
}
