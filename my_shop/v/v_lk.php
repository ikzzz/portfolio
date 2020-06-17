
<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>
        <?=$info?>
        <h2><?=$_COOKIE['username'];?>, доброе время суток!</h2>
        <div id="content">
		<?=$info?>

		Ваш заказ:
	<table border="1">
	<th>Заказ</th>
	<th>Стоймость</th>
	<th>Статус</th><th></th>
	<? 
	$id_user = $_COOKIE['userid'];
    if(isset($orders)){
		foreach ($orders as $order):?>
			<tr>
            <td> <div class="shopUnitName">
                <?php echo $order['goods']; ?>
         	</div></td><td>     
            <div class="shopUnitShortDesc">
                <?php echo $order['price']; ?>
           </div></td><td>
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
           </div></td><td>
           <div class="shopUnitShortDesc">
                <? if($order['flag']==0):?>
                <a href="index.php?act=cancelOrder&c=basket&id=<?=$order['id']?>">отменить заказ</a>
              <? endif ?>
           </div></td></tr>
       	 <?php endforeach;}; ?>
</table>



    </div>
</div>
<script src='../js/my.js' defer></script>
</body>
</html>