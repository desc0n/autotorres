<form>
    <div class="row">
        <div class="col-lg-2">
            <input type="text" class="form-control" name="first_date" id="firstDate" value="<?=$first_date;?>">
        </div>
        <div class="col-lg-2">
            <input type="text" class="form-control" name="last_date" id="lastDate" value="<?=$last_date;?>">
        </div>
        <div class="col-lg-3">
            <button class="btn btn-primary">Фильтровать</button>
        </div>
    </div>
</form>
<table class="table table-bordered orders-list-table">
    <thead>
        <tr>
            <th>Номер заказа</th>
            <th>Дата оформления</th>
            <th>Машина</th>
            <th>Принял</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?foreach ($ordersList as $order) {?>
        <tr>
            <td><?=$order['id'];?></td>
            <td><?=date('H:i d.m.Y', strtotime($order['created_at']));?></td>
            <td><?=$order['brand'];?> <?=$order['model'];?> <?=$order['frame'];?></td>
            <td><?=$order['username'];?></td>
            <td class="text-center">
                <a class="btn btn-default" href="/crm/order/<?=$order['id'];?>"><i class="fa fa-file fa-fw"></i></a>
            </td>
        </tr>
        <?}?>
    </tbody>
</table>