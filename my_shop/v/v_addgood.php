<title><?=$title?></title>
<body>
<div id="container">
    <div class="content">
      <div class='goodsTable'>
        <h1><?=$title?></h1>
        
            <?=$message?>
            <div id="openedProduct-content">
                <form enctype="multipart/form-data" method="post">
                    <p>Название товара
                    <input type="text" name="name" value=""></p>
                    <p>Цена товара
                    <input type="text" name="price" value=""></p>
                    <p>Описание товара</p>
                    <textarea rows="10" cols="47" name="desc"></textarea></p>
                    <p>Изображение товара
                    <input type="file" name="big_img" value="" accept="image/jpeg,.jpg,.png,.gif"></p>
                    <input type="reset" name="clear" value="Очистить">
                    <input type="submit" name="addgood" value="Добавить">
                </form>
            </div>
        </div>
    </div>
</div>