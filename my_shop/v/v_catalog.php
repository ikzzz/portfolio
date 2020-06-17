<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
    	
        <h1><?=$title?></h1>
        <div id="shopWrap">
	<?
     foreach ($goods as $good): ?>
        <div class="shopUnit">
            <div class="shopUnitName">
                <?php echo $good['name']; ?> 
            </div>
            <img src="<?php echo $good['small_img']; ?>"/>
            <div class="shopUnitShortDesc">
                <?php echo $good['desc']; ?>
            </div>
            <div class="shopUnitPrice">
                Цена: <?php echo $good['price']; ?>
            </div>
            <? if ($_COOKIE['login'] == 'admin'){
                ?><a href="index.php?act=editgood&c=admin&id=<? echo $good['id'];?>" class="shopUnitMore"> 
                Редактировать товар</a>
                <a href="index.php?act=deleteGood&c=admin&id=<? echo $good['id'];?>" class="shopUnitMore"> 
                 Удалить товар </a> 
                <?}
                else { ?> 
            <a href="index.php?c=page&act=good&id=<?php echo $good['id']; ?>" class="shopUnitMore">
                Подробнее
            </a>
            <? if (isset($_COOKIE['login'])) {?>
            <a href="index.php?act=add&c=basket&id=<?php echo $good['id']; ?>" class="shopUnitMore">Добавить в корзину</a>
                <?};
            };?>
        </div>
    <?php endforeach;?>
    <? if ($_COOKIE['login'] == 'admin'){
                echo " <div class=\"shopUnit\"> <a href=\"index.php?act=addgood&c=admin\" class=\"shopUnitMore\"> 
                <h3>Добавить новый товар</h3>
                </a></div>";}
    ?>  
</div>
</div>
</div>