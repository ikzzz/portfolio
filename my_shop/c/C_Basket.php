<?
include_once('m/model.php');
include_once 'm/Basket.php';

class C_Basket extends C_Base
{
	public function action_add(){
			$this->title .= 'add';
            $id_good = $_GET['id'];
            $id_user =  $_COOKIE['userid'];
            $basket_object = new Basket;
            $goodPrice = $basket_object->getONEgood($id_good);
            $price = $goodPrice['price'];
            $count = 1;
            $res = $basket_object->SelectOne($id_good, $id_user);
                 if($res['id_good'] == $id_good){
                    $basket_object->UpdBasket($id_good, $id_user);
                    header("Location: index.php?c=page&act=catalog");
                 }
                else{
                $basket_object->addBasket($id_good, $count, $id_user, $price);
                header("Location: index.php?c=page&act=catalog");
            }; 
	}

	public function action_dell(){
			$this->title .= 'dell';
			$id = $_GET['id'];
    		$count = 1;
    		$basket_object = new Basket;
    		$basket_object->deleteGoodToBasket($id);
    		header("Location: index.php?c=page&act=basket");
	}

	public function action_buy(){
			$this->title = 'Заполните форму для заказа';
			$basket_object = new Basket;
			if($_POST){
				$id_user = $_COOKIE['userid'];
				$carts = $basket_object->getAllCarts($id_user);
				$nameUsers = $basket_object->getOneUser($id_user);
				$nameUser = $nameUsers['name'];
	    		$userAdres = trim(strip_tags($_POST['adres']));
	    		$comment = trim(strip_tags($_POST['comment']));
	    		$userPhone = trim(strip_tags($_POST['phone']));
	    			foreach ($carts as $cart) {
	    				$id_good = $cart['id_good'];
	    				$cartsCount = $cart['count'];
	    				$nGood = $basket_object->getONEgood($id_good);
	    				$nameGood = $nGood['name'];
	    				$textOrder .= " ".$nameGood." в количестве". $cartsCount."шт., ";
	       			};
	    		$price = $basket_object->getOrderSum($id_user);
	    		$flag = 0;
	                    $basket_object->addOrder($id_user, $nameUser, $userAdres, $userPhone, $comment, $textOrder, $price, $flag);
	                    $basket_object->ClearBasket($id_user);
	                    header("Location: index.php?c=page&act=lk");

            }
            $this->content = $this->Template('v/v_buy.php', array('info' => $info));
    }

    public function action_cancelOrder(){
    		$id = $_GET['id'];
    		$basket_object = new Basket;
    		$basket_object->CancelOrder($id);
    		header("Location: index.php?c=page&act=lk");
    }
}