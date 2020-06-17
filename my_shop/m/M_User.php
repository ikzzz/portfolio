<?
require_once "configs/config.php";
include_once('m/model.php');
include_once 'SQL.php';

	class M_User extends SQL {

		public $product_id, $product_image, $product_title, $product_content, $product_price;

		public function getUserOrders($id_user) {

			return parent::SelectAllFromID('orders', 'id_user', $id_user);
		}

		public function getAllUsers() {

			return parent::Select('user');
		}

		public function RegUser($name, $login, $email, $pass) {

			return parent::NewUser($name, $login, $email, $pass);
		}

		public function getUser($id_user) {

			return parent::SelectOneUser($id_user);
		}

		public function login($login, $pass) {

			return parent::login($login, $pass);
		}

		public function getID($login, $pass) {

			return parent::getUserId($login, $pass);
		}
	}