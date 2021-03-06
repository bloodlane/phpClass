<?php 
	class Product{
		private $product_id;
		private $product_name;
		private $product_desc;
		private $product_type;
		private $product_created_date;
		private $product_modified_date;
		private $product_created_ip;
		private $product_modified_ip;

		private $con = null;

		public function __construct(){
			$this->product_id = "";
			$this->product_id= "";
			$this->product_name= "";
			$this->product_desc= "";
			$this->product_type= "";
			$this->product_created_date= "";
			$this->product_modified_date= "";
			$this->product_created_ip= "";
			$this->product_modified_ip= "";

			$this->con = $this->db();
		}

		//display properties
		function display(){
			echo $this->product_id."<br>";
			echo $this->product_name."<br>";
			echo $this->product_desc."<br>";
			echo $this->product_type."<br>";
			echo $this->product_created_date."<br>";
			echo $this->product_modified_date."<br>";
			echo $this->product_created_ip."<br>";
			echo $this->product_modified_ip."<br>";
		}


		//getters
		function getProductId(){
			return $this->product_id;
		}
		function getProductName(){
			return $this->product_name;
		}
		function getProductDesc(){
			return $this->product_desc;
		}
		function getProductType(){
			return $this->product_type;
		}
		function getProductCreatedDate(){
			return $this->product_created_date;
		}
		function getProductModifiedDate(){
			return $this->product_modified_date;
		}
		function getProductCreatedIp(){
			return $this->product_created_ip;
		}
		function getProductModifiedIp(){
			return $this->product_modified_ip;
		}

		//setters

		function setProductId($p_id){
			$this->product_id = $p_id;
		}

		function setProductName($p_name){
			$this->product_name = $p_name;
		}

		function setProductDesc($p_desc){
			$this->product_desc = $p_desc;
		}

		function setProductType($p_type){
			$this->product_type = $p_type;
		}

		function setProductCreatedDate($p_createdDate){
			$this->product_created_date = $p_createdDate;
		}
		function setProductModifiedDate($p_modifiedDate){
			$this->product_modified_date = $p_modifiedDate;
		}

		function setProductCreatedIp($p_createdIp){
			$this->product_created_ip = $p_createdIp;
		}
		function setProductModifiedIp($p_modifiedIp){
			$this->product_modified_ip = $p_modifiedIp;
		}

		//database functions CRUD

		function db(){
			try {
				$db = new PDO("mysql:host=localhost;dbname=my_db","root","admin123");
				echo "Connected to Database!";
				return $db;
			} catch (PDOException $e) {
				echo "Failed Connection".'<br>'.$e;
			}
		}

		function addProduct($product_id, $product_name, $product_desc, $product_type, $product_created_date, $product_modified_date, $product_created_ip, $product_modified_ip){			
			$sql = "INSERT INTO products(product_id, product_name, product_desc, product_type, product_created_date, product_modified_date, product_created_ip, product_modified_ip) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$st = $this->con->prepare($sql);
			$st->execute(array($product_id, $product_name, $product_desc, $product_type, $product_created_date, $product_modified_date, $product_created_ip, $product_modified_ip));
			$db = null;
		}

		function getAllProducts(){
			
			$sql = "SELECT * FROM products ORDER BY id DESC";
			$st = $this->con->prepare($sql);
			$st->execute();
			$products = $st->fetchAll();
			$db = null;
			return $products;
		}
		function get_products($limit, $offset){	
			//$db = new PDO("mysql:host=localhost;dbname=my_db","root","admin123");
			$sql = "SELECT * FROM products ORDER BY id DESC LIMIT $offset, $limit";
			$st = $this->con->prepare($sql);
			$st->execute();
			$products = $st->fetchAll();
			$db = null;
			return $products;
		}

	}//end of class
 ?>