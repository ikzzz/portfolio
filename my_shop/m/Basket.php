<?
require_once "configs/config.php";
include_once('m/model.php');
include_once 'SQL.php';

	class Basket extends SQL {

		public $product_id, $product_image, $product_title, $product_content, $product_price;

		public function getAllCarts($id_user) {

			return parent::SelectAllFromID('basket', 'id_user', $id_user);
		}

		public function getONEgood($id_good) {

			return parent::Select('goods', 'id', $id_good);
		}

		public function SelectOne($id_good, $id_user) {

			return parent::SelectOneCart($id_good, $id_user);
		}

		public function UpdBasket($id_good, $id_user) {

			return parent::UpdateBasket($id_good, $id_user);
		}

		public function addBasket($id_good, $count, $id_user, $price) {

			return parent::InsertToBasket($id_good, $count, $id_user, $price);
		}

		public function deleteGoodToBasket($id) {

			return parent::Remove('basket', $id);
		}

		public function getOneUser($id_user) {

			return parent::SelectOneUser($id_user);
		}
		
		public function getOrderSum($id_user) {
			$allCart = parent::SelectAllCart($id_user);
			foreach ($allCart as $cart) {
				$sum = $cart['count'] * $cart['price'];
				$totalSum = $totalSum + $sum;
			}
			return $totalSum;
		}

		public function addOrder($id_user, $nameUser, $userAdres, $userPhone, $comment, $textOrder, $price, $flag) {

			return parent::NewOrder($id_user, $nameUser, $userAdres, $userPhone, $comment, $textOrder, $price, $flag);
		}

		public function ClearBasket($id_user) {

			return parent::RemoveAllToBasket($id_user);
		}

		public function CancelOrder($id) {

			return parent::Remove('orders', $id);
		}

		public function getBasketCount($id_user) {
			$allCart = parent::SelectAllCart($id_user);
			foreach ($allCart as $cart) {
				$sum = $cart['count'];
				$totalCount = $totalCount + $sum;
			}
			return $totalCount;
		}
	}