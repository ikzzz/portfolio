<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>
<a href="index.php?act=oldorders&c=admin" class="shopUnitMore">Просмотреть выполненые заказы</a><br>
<table border="1">
  <th>Имя</th>
  <th>Адрес</th>
  <th>Телефон</th>
  <th>Комментарий к заказу</th>
	<th>Заказ</th>
	<th>Стоймость</th>
	<th>Статус</th>
  <th colspan="3">Варианты действий</th>
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
          <td><div class="shopUnitName">
                <?=$order['goods']?>
         	      </div>
            </td>
            <td>     
                <div class="shopUnitShortDesc">
                <?=$order['price']?>
                </div>
            </td>
            <td>
           <div class="shopUnitShortDesc">
                <?php 
                if($order['flag']==0){
                	echo "в обработке";
                }
                elseif($order['flag']==1){
                	echo "выполнен";
                }
                elseif($order['flag']==3){
                  echo "отменён";
                }
                ?>
           </div>
           </td>
           <td>
           <div class="shopUnitShortDesc">
                <a href="index.php?c=admin&act=cancelOrder&id=<?=$order['id']?>">отменить заказ</a>
           </div>
           </td>
           <td>
           <div class="shopUnitShortDesc">
                <a href="index.php?c=admin&act=deleteOrder&id=<?=$order['id']?>">удалить заказ</a>
           </div>
           </td>
           <td>
           <div class="shopUnitShortDesc">
                <a href="index.php?c=admin&act=accept&id=<?=$order['id']?>">выполнить заказ</a>
           </div>
           </td>
      </tr>
  <?php endforeach; ?>
</table>
</div>