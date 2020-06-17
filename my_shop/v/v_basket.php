<?php
 ///
 ?>
<title><?=$title?></title>
<body>
<div id="container">
    <div class="content">
      <div class='goodsTable'>
        <h1><?=$title?></h1>
        <div>
          <table border="1">
	<?
  	foreach ($carts as $cart):?>
      <tr border="1">
                <? $product_id= $cart['id_good'];
                    $product_object = new Product;
                    $goodInfo = $product_object->getProduct($product_id);
                   
                   ?>
                		  <?php echo $goodInfo['name']; ?>
           	 			 <div class="shopUnitShortDesc">
                			<?php echo $goodInfo['desc']; ?>
           				 </div>
            			 <div class="shopUnitPrice">
                		    Цена: <?php echo $goodInfo['price']; $onePrice = $goodInfo['price']; ?>
            			 </div>
                Количество: <?php echo $cart['count']; $oneCount = $cart['count'];  ?>
                <a href="index.php?act=dell&c=basket&id=<?php echo $cart['id']; ?>" class="shopUnitMore">Удалить</a>
                <br>
            	<?
            	$onePrice = $onePrice * $oneCount;
            	$allBuyPrice = $allBuyPrice + $onePrice;
         		?>
        </tr>
    <?php endforeach; ?>
  </table>
    <div class="shopUnitPrice">
                		    Итоговая стоймость: <?php echo $allBuyPrice; ?>
            			</div>
    <? if($allBuyPrice > 0):?>              
    <a href="index.php?act=buy&c=basket&id=<?php echo $cart['id_user']; ?>" class="shopUnitMore">Оформить заказ</a>
  <? endif ?>
                <br>
</div></div></div></div>
