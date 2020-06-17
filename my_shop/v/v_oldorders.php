<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>
<a href="index.php?act=allorders&c=admin" class="shopUnitMore">Просмотреть новые заказы</a><br>
<table border="1">
  <th>Имя</th>
  <th>Адрес</th>
  <th>Телефон</th>
  <th>Комментарий к заказу</th>
  <th>Заказ</th>
  <th>Стоймость</th>
  <th>Статус</th>
  <? 
    foreach ($orders as $order):?>
      <tr>
          <td><div class="shopUnitName">
                <?=$order['name_user']?>
                </div>
            </td>
             <td><div class="shopUnitName">
                <?=$order['user_adres']?>
                </div>
            </td>
             <td><div class="shopUnitName">
                <?=$order['user_phone']?>
                </div>
            </td>
             <td><div class="shopUnitName">
                <?=$order['comment']?>
                </div>
            </td>
            <td> <div class="shopUnitName">
                <?=$order['goods']?>
          </div></td><td>     
            <div class="shopUnitShortDesc">
                <?=$order['price']?>
           </div></td><td>
           <div class="shopUnitShortDesc">
                выполнен
           </div></td></tr>
         <?php endforeach; ?>
</table>
</div>