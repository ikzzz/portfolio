<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
    	
        <h1><?=$title?></h1>
<div id="openedProduct-img">
    <img src="<?php echo $good['big_img']; ?>">
</div>
<div id="openedProduct-content">
    <h1 id="openedProduct-name">
        <?php echo $good['name']; ?>
    </h1>
    <div id="openedProduct-desc">
        <?php echo $good['desc']; ?>
    </div>
    <div id="openedProduct-price">
        Цена: <?php echo $good['price']; ?>
        <? if (isset($_COOKIE['login'])) {?>
            <a href="index.php?act=add&c=basket&id=<?php echo $good['id']; ?>" class="shopUnitMore">Купить</a>
                <?};?>
    </div>
</div></div>