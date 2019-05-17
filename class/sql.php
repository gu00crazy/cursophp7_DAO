<?php

	//agora temos uma classe que e estendida da classe pdo

	class Sql extends PDO {

		private $conn;


		//queremos que quando um objeto estancie essa classe, ele automaticamente faca uma conexao com o banco de dados, para isso chamamos o metodo construtor 
		public function __construct(){

			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

		}

		
		//setando varios parametros atraves de um array


		private function setParams($statment, $parameters = array()){

			foreach ($parameters as $key => $value) {
				
				$this->setParam( $key, $value);

			}


		}

		//setando apenas um param

		private function setParam($statment,$key,$value){

			$statment->bindParam($key, $value);

		}

		//o parametro params e um array, pois sao nossos dados a serem armazenados, o "$rawquery" e nosso comando 

		//para executar um comando, que seria preparar, fazer o bind dos parametros e executar, criamos o metodo a seguir

		public function query($rawQuery, $params = array()) {

			$stmt = $this->conn->prepare($rawQuery);

			$this->setParams($stmt, $params);

			$stmt->execute();

			return $stmt;
		}

		//criamos acima um metodo que nao retorna nada do banco de dados, mas agora para criar um que retorna e simples pois ja criamos a basse em outros metodos, vamos criar um metodo para o select 

		public function select($rawQuery, $params = array()):array{

			$stmt = $this->query($rawQuery, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}


	}


  ?>p