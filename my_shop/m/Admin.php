<?
require_once "configs/config.php";
include_once('m/model.php');
include_once 'SQL.php';

	class Admin extends SQL {

		public $product_id, $product_image, $product_title, $product_content, $product_price;

		public function AllUser() {

			return parent::Select('user');
		}

		public function NewOrdersList($flag_num) {

			return parent::SelectAllFromID('orders', 'flag', $flag_num);
		}
		public function OldOrdersList($flag_num) {

			return parent::SelectAllFromID('orders', 'flag', $flag_num);
		}

		public function deleteOrder($id) {

			return parent::Remove('orders', $id);
		}

		public function updateStatusOrder($flag_num, $id) {

			return parent::UpdateOrder('orders', $flag_num, $id);
		}

		public function addNewGood($nameShort, $fileName, $nameFull, $big_path, $small_path, $price, $count) {

			return parent::InsertGood($nameShort, $fileName, $nameFull, $big_path, $small_path, $price, $count);
		}

		public function updateGoodNoPicture($nameShort, $nameFull, $price, $id) {

			return parent::UpdateGoodNoPic($nameShort, $nameFull, $price, $id);
		}

		public function updateGoodWithPicture($nameShort, $fileName, $nameFull, $big_path, $small_path, $price, $id) {

			return parent::UpdateGoodWithPic($nameShort, $fileName, $nameFull, $big_path, $small_path, $price, $id);
		}

		public function deleteGood($id) {

			return parent::Remove('goods', $id);
		}

		public function delGoodFromUserBasket($id) {

			return parent::Remove('basket', $id);
		}

	}