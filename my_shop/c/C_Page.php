<?php

include_once('m/model.php');
include_once 'm/Product.php';
include_once 'm/M_User.php';
include_once 'm/Basket.php';

class C_Page extends C_Base
{
	
	public function action_index(){
		$this->title .= '';
		$text = text_get();
		$basket_object = new Basket;
		if(isset($_COOKIE['userid'])){
			$id_user = $_COOKIE['userid'];
			$this->keyWords = $basket_object->getBasketCount($id_user);
		}
		//$today = date();
		$this->content = $this->Template('v/v_index.php', array('text' => $text));	
	}

	public function action_edit(){
		$this->title = 'Редактирование текста главной страницы';
		
		if($this->isPost())
		{
			text_set($_POST['text']);
			header('location: index.php');
			exit();
		}
		
		$text = text_get();
		$this->content = $this->Template('v/v_edit.php', array('text' => $text));		
	}
	
	public function action_catalog() {
			
			$product_object = new Product();
			$goods = $product_object->getAllProducts();
			$basket_object = new Basket;
			if(isset($_COOKIE['userid'])){
				$id_user = $_COOKIE['userid'];
				$this->keyWords = $basket_object->getBasketCount($id_user);
			}
			$this->title = 'Каталог';
			$this->content = $this->Template('v/v_catalog.php', array('goods' => $goods));
		}

	public function action_good() {
			$basket_object = new Basket;
			if(isset($_COOKIE['userid'])){
				$id_user = $_COOKIE['userid'];
				$this->keyWords = $basket_object->getBasketCount($id_user);
			}
			$id = $_GET['id'];
			$product_object = new Product();
			$good = $product_object->getProduct($id);
			$this->content = $this->Template('v/v_good.php', array('good' => $good));
		}

	public function action_lk(){
		$this->title = 'Личный кабинет';
		$title = 'Личный кабинет';
		$basket_object = new Basket;
			if(isset($_COOKIE['userid'])){
				$id_user = $_COOKIE['userid'];
				$this->keyWords = $basket_object->getBasketCount($id_user);
			}
		$id_user = $_COOKIE['userid'];
		$user_objects = new M_User();
		$orders = $user_objects->getUserOrders($id_user);
		$this->content = $this->Template('v/v_lk.php', array('orders' => $orders));		
	}

	public function action_basket(){
		$this->title = 'Корзина';
		$basket_object = new Basket;
			if(isset($_COOKIE['userid'])){
				$id_user = $_COOKIE['userid'];
				$this->keyWords = $basket_object->getBasketCount($id_user);
			}
		$id_user =  $_COOKIE['userid'];
	 	$action = $_GET['action'];
		$basket_object = new Basket();
		$carts = $basket_object->getAllCarts($id_user);
		
		$this->content = $this->Template('v/v_basket.php', array('carts' => $carts));		
	}
}