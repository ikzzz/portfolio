<?php
	
	include_once 'configs/config.php';

	class SQL {
		
		private static $instance;
		private $db;
		
		public static function Instance() {
			
			if (self::$instance == null) {
				self::$instance = new SQL();
			}

			return self::$instance;
		}
		
		public function __construct() {
			
			setlocale(LC_ALL, 'ru_RU.UTF8');
			$this->db = new PDO(DRIVER . ':host='. SERVER . ';port='.SERVER_PORT.';dbname=' . DB, USERNAME, PASSWORD);
			$this->db->exec('SET NAMES UTF8');
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}
		
		public function Select($table, $where_key = false, $where_value = false, $fetchAll = false) {

			if ($where_key AND $where_value AND !$join) {
				$query = "SELECT * FROM " . $table . " WHERE " . $where_key . " = '" . $where_value . "'";
			} else {
				$query = "SELECT * FROM " . $table;
			}

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}

			if ($fetchAll) {
				return $q->fetchAll();
			} else if ($where_key AND $where_value) {
				return $q->fetch();
			} else {
				return $q->fetchAll();
			}
		}

		public function SelectAllFromID($table, $where_key = false, $where_value = false, $fetchAll = false) {

				$query = "SELECT * FROM " . $table . " WHERE " . $where_key . " = '" . $where_value . "'";

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			return $q->fetchAll();
		}

        public function SelectJoin($table1, $table2, $t1key, $t2key, $par1 = false, $par2 = false) {

		    $query = "SELECT * FROM " . $table1 . " AS T1 INNER JOIN " . $table2 . " AS T2 ON T1. " . $t1key . " = T2. " . $t2key . " WHERE T1. " . $par1 . " = " . $par2;

            $q = $this->db->prepare($query);
            $q->execute();

            if ($q->errorCode() != PDO::ERR_NONE) {
                $info = $q->errorInfo();
                die($info[2]);
            }
            return $q->fetchAll();
        }
		//"SELECT order_id, product_id, count, title, price FROM basket AS T1 INNER JOIN products AS T2 ON T1.product_id = T2.id WHERE T1.user_id = " . $_SESSION["user_id"]
		
		public function Insert($table, $object) {
			
			$columns = array();
			
			foreach ($object as $key => $value) {
			
				$columns[] = $key;
				$masks[] = ":$key";
				
				if ($value === null) {
					$object[$key] = 'NULL';
				}
			}
			
			$columns_s = implode(',', $columns);
			$masks_s = implode(',', $masks);
			
			$query = "INSERT INTO $table ($columns_s) VALUES ($masks_s)";
			
			$q = $this->db->prepare($query);
			$q->execute($object);
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $this->db->lastInsertId();
		}
		
		public function Update($table, $object, $where) {
			
			$sets = array();
			 
			foreach ($object as $key => $value) {
				
				$sets[] = "$key=:$key";
				
				if ($value === NULL) {
					$object[$key]='NULL';
				}
			 }
			 
			$sets_s = implode(',',$sets);
			$query = "UPDATE $table SET $sets_s WHERE $where";

			$q = $this->db->prepare($query);
			$q->execute($object);

			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $q->rowCount();
		}
		
		
		public function Delete($table, $where) {
			
			$query = "DELETE FROM $table WHERE $where";
			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $q->rowCount();
		}

        public function Remove($table, $id) {

            $query = "DELETE FROM $table WHERE id = $id";
            $q = $this->db->prepare($query);
            $q->execute();

            if ($q->errorCode() != PDO::ERR_NONE) {
                $info = $q->errorInfo();
                die($info[2]);
            }

            return $q->rowCount();
        }

		public function Password ($name, $password) {
			
			return strrev($name) . md5($password);
		}

		public function UpdateOrder($table, $flag_num, $id) {
			 
			$query = "UPDATE $table SET `flag`=$flag_num  WHERE id=$id";

			$q = $this->db->prepare($query);
			$q->execute($object);

			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $q->rowCount();
		}

		public function InsertGood($nameShort, $fileName, $nameFull, $big_path, $small_path, $price, $count) {
			
			$query = "INSERT INTO `goods` (name, pic_name, `desc`, small_img, big_img, price, count) VALUES ('$nameShort', '$fileName', '$nameFull', '$big_path', '$small_path', '$price', '$count')";
			
			$q = $this->db->prepare($query);
			$q->execute($object);
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $this->db->lastInsertId();
		}

		public function UpdateGoodNoPic($nameShort, $nameFull, $price, $id) {
			 
			$query = "UPDATE `goods` SET `name`='$nameShort', `desc`='$nameFull', `price`='$price' WHERE id='$id'";
			$q = $this->db->prepare($query);
			$q->execute($object);

			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $q->rowCount();
		}

		public function UpdateGoodWithPic($nameShort, $fileName, $nameFull, $big_path, $small_path, $price, $id) {
			 
			$query = "UPDATE `goods` SET `name`='$nameShort', `pic_name`='$fileName', `desc`='$nameFull', `big_img`='$big_path', `small_img`='$small_path', `price`='$price' WHERE id='$id'";
			$q = $this->db->prepare($query);
			$q->execute($object);

			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $q->rowCount();
		}

		public function SelectOneCart($id_good, $id_user) {

				$query = "SELECT id_good FROM basket WHERE id_user=$id_user AND id_good=$id_good";

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			return $q->fetch();
		}

		public function UpdateBasket($id_good, $id_user) {
			 
			$query = "UPDATE basket SET `count`= `count`+1  WHERE id_good=$id_good AND id_user=$id_user";
			$q = $this->db->prepare($query);
			$q->execute($object);

			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $q->rowCount();
		}

		public function InsertToBasket($id_good, $count, $id_user, $price) {
			
			$query = "INSERT INTO basket (id_good, count, id_user, price) VALUES ('$id_good','$count','$id_user', '$price')";
			
			$q = $this->db->prepare($query);
			$q->execute($object);
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $this->db->lastInsertId();
		}

		public function SelectOneUser($id_user) {

				$query = "SELECT * FROM user WHERE id=$id_user";

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			return $q->fetch();
		}

		public function NewOrder($id_user, $nameUser, $userAdres, $userPhone, $comment, $textOrder, $price, $flag) {
			
			$query = "INSERT INTO orders (id_user, name_user, user_adres, user_phone, comment, goods, price, flag) VALUES ('$id_user', '$nameUser', '$userAdres', '$userPhone', '$comment', '$textOrder', '$price', '$flag')";
			
			$q = $this->db->prepare($query);
			$q->execute($object);
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $this->db->lastInsertId();
		}

		public function RemoveAllToBasket($id_user) {

            $query = "DELETE FROM basket WHERE id_user = $id_user";
            $q = $this->db->prepare($query);
            $q->execute();

            if ($q->errorCode() != PDO::ERR_NONE) {
                $info = $q->errorInfo();
                die($info[2]);
            }

            return $q->rowCount();
        }

        public function NewUser($name, $login, $email, $pass) {
			
			$query = "INSERT INTO user (name, login, email, pass) VALUES ('$name', '$login', '$email', '$pass')";
			
			$q = $this->db->prepare($query);
			$q->execute($object);
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			
			return $this->db->lastInsertId();
		}

        public function login($login, $pass) {

			$query = "SELECT id FROM user WHERE login='$login' AND pass = '$pass'";

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			return $q->columnCount();
		}

		 public function getUserId($login, $pass) {

			$query = "SELECT id FROM user WHERE login='$login' AND pass = '$pass'";

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			return $q->fetch();
		}

		public function SelectAllCart($id_user) {

				$query = "SELECT * FROM basket WHERE id_user=$id_user";

			$q = $this->db->prepare($query);
			$q->execute();
			
			if ($q->errorCode() != PDO::ERR_NONE) {
				$info = $q->errorInfo();
				die($info[2]);
			}
			return $q->fetchAll();
		}
	}
?>