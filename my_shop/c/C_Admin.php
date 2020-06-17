<?php
include_once('m/model.php');
include_once 'm/Admin.php';
include_once 'm/Product.php';

class C_Admin extends C_Base
{

	public function action_index(){
		$this->title .= 'Страница управления';
		
		$this->content = $this->Template('v/v_admin.php', array('text' => $text));	
	}

	public function action_addgood(){
		$this->title .= ' Создание нового товара';
		if($_POST)
      {
    	  $nameShort = trim(strip_tags($_POST['name']));
    	  $nameFull = trim(strip_tags($_POST['desc']));
    	  $price = (int)trim(strip_tags($_POST['price']));
    	  $filePath = $_FILES['big_img']['tmp_name']; 
    	  $type = $_FILES['big_img']['type'];
    	  $fileName = $_FILES['big_img']['name'];
    	  $size = $_FILES['big_img']['size'];
    	  if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif')
          {
        	  if ($size > 0 and $size < 1000000)
              {
            	  if (copy($filePath, DIR_BIG . $fileName))
                  {
                	  $type = explode('/', $_FILES['big_img']['type'])[1];
                	  changeImage(300, 300, DIR_BIG . $fileName, DIR_SMALL . $fileName, $type);
                    $admin_object = new Admin();
                    $admin_object->addNewGood($nameShort, $fileName, $nameFull, DIR_SMALL . $fileName, DIR_BIG . $fileName, $price, 1);
                    header("Location: index.php?c=page&act=catalog");
        			      $message = "<h3>Файл успешно загружен на сервер</h3>";
            	    } 
                else 
                    {
                	     $message = "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
                	     exit;
            	      }
        	     } 
            else 
                {
            	     $message = "<b>Ошибка - картинка превышает 1 Мб.</b>";
        	      }
    	    }
        else
            {
        	     $message = "<b>Картинка не подходит по типу! Картинка должна быть в формате JPEG, PNG или GIF</b>";
    	       }
    	}
    $this->content = $this->Template('v/v_addgood.php', array('message' => $message));

	}
	public function action_deleteGood(){
		$this->title .= ' Товар удалён';
    		$id_good = $_GET['id'];
    		$count = 1;
        $admin_object = new Admin;
        $admin_object->deleteGood($id_good);
    		$admin_object->delGoodFromUserBasket($id_good);
    		header("Location: index.php?c=page&act=catalog");
	}


	public function action_editgood(){
		$this->title = ' Редактирование товара';
    $id = $_GET['id'];
    $product_id = $id;
    $product_object = new Product;
    $goodIform = $product_object->getProduct($product_id);
		$nameShort = trim(strip_tags($_POST['name']));
		$nameFull = trim(strip_tags($_POST['desc']));
		$price = (int)trim(strip_tags($_POST['price']));
		if($_FILES['big_img']['error'] == 4)
      {
        $admin_object = new Admin;
        $admin_object->updateGoodNoPicture($nameShort, $nameFull, $price, $id);
  			header("Location: index.php?c=page&act=catalog");
			}
			else
          {
  				  $filePath = $_FILES['big_img']['tmp_name']; 
      			$type = $_FILES['big_img']['type'];
      			$fileName = $_FILES['big_img']['name'];
      			$size = $_FILES['big_img']['size'];
      			if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif')
              {
          			if ($size > 0 and $size < 1000000)
                  {
              			if (copy($filePath, DIR_BIG . $fileName))
                      {
                  			$type = explode('/', $_FILES['big_img']['type'])[1];
                  			changeImage(300, 300, DIR_BIG . $fileName, DIR_SMALL . $fileName, $type);
                        $admin_object = new Admin;
                  			$admin_object->updateGoodWithPicture($nameShort, $fileName, $nameFull, DIR_BIG . $fileName, DIR_SMALL . $fileName, $price, $id);
                  			header("Location: index.php?c=page&act=catalog");
              			  };
          			  };
      			  };
			};
    	$this->content = $this->Template('v/v_editgood.php', array('goodIform' => $goodIform));	
	}

	public function action_allusers(){
		$this->title = 'Все зарегистрированые пользователи сайта';
    $admin_object = new Admin();
    $users = $admin_object->AllUser();
		$this->content = $this->Template('v/v_allusers.php', array('users' => $users));	
	}

	public function action_allorders(){
		$this->title .= ' Новые заказы ';
    $flag_num = 0;
		$admin_object = new Admin();
    $orders = $admin_object->NewOrdersList($flag_num);	
		$this->content = $this->Template('v/v_allorders.php', array('orders' => $orders));	
	}

	public function action_accept(){
		$this->title .= ' Выполненые заказы ';
		$id = $_GET['id'];
    $flag_num = 1;
    $admin_object = new Admin();
    $orders = $admin_object->updateStatusOrder($flag_num, $id);
    header("Location: index.php?act=allorders&c=admin");
    }

  public function action_deleteOrder(){
		$this->title .= 'Удаление заказа';
		$id = $_GET['id'];
    $admin_object = new Admin();
    $orders = $admin_object->deleteOrder($id);	
    header("Location: index.php?act=allorders&c=admin");
  }

  public function action_cancelOrder(){
		$this->title .= ' Отмена заказа ';
		$id = $_GET['id'];
    $flag_num = 3;
    $admin_object = new Admin();
    $orders = $admin_object->updateStatusOrder($flag_num, $id);
    header("Location: index.php?act=allorders&c=admin");
  }

  public function action_oldorders(){
	  $this->title .= ' Выполненые заказы ';
    $flag_num = 1;
    $admin_object = new Admin();
    $orders = $admin_object->OldOrdersList($flag_num); 
    $this->content = $this->Template('v/v_oldorders.php', array('orders' => $orders));  	
	}
}