<title><?=$title?></title>
<body>
<div id="container">
    </div>
    <div class="content">
        <h1><?=$title?></h1>
<div id="openedProduct-content">
<form enctype="multipart/form-data" method="post">
    <img src="<?=$goodIform['small_img']?>">
    <input type="hidden" name="id" value="<?=$id?>">
    <p>Название товара
    <input type="text" name="name" value="<?=$goodIform['name']?>"></p>
    <p>Цена товара
    <input type="text" name="price" value="<?=$goodIform['price']?>"></p>
    <p>Описание товара</p>
    <textarea rows="10" cols="47" name="desc"><?=$goodIform['desc']?></textarea></p>
    <p>Изображение товара
    <input type="file" name="big_img" value="" accept="image/jpeg,.jpg,.png,.gif"></p>
    <input type="submit" name="apply" value="Применить">
</form>
</div>
</div>