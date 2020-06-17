<?php

	include_once 'SQL.php';

	class Product extends SQL {

		public $product_id, $product_image, $product_title, $product_content, $product_price;

		public function getAllProducts() {

			return parent::Select('goods');
		}

		public function getProduct($product_id) {

			return parent::Select('goods', 'id', $product_id);
		}
	}
?>