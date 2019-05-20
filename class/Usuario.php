<?php

	class Usuario{

		//conectando com uma classe que e conectada com o banco de dados 

		//criando variaveis existentes no db

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}
		public function setIdusuario($idusuario){
			$this->idusuario = $idusuario;
		}
		public function getDeslogin(){
			return $this->deslogin;
		}
		public function setDeslogin($deslogin){
			$this->deslogin = $deslogin;
		}
		public function getDessenha(){
			return $this->dessenha;
		}
		public function setDessenha($dessenha){
			$this->dessenha = $dessenha;
		}
		public function getDtcadastro(){
			return $this->dtcadastro;
		}
		public function setDtcadastro($dtcadastro){
			$this->dtcadastro = $dtcadastro;
		}


		//basicamente, voce vai passar um parametro para um metodo, exemplo carregando id no index.php, dessa forma a pessoa que usa essa classe pode nem saber qual db ele esta trabalhando com

		public function loadById($id){

			//ja criamos a classe sql para um select simples, basta instanciar em um objeto
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID",array(
					":ID"=>$id
			));

			if(count($results) > 0){

			$this->setData($results[0]);

			}
		}

		public function __toString(){

			return json_encode(array(

				"idusuario"=>$this->getIdusuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
			));


		}

		//atraves dessa lista trazemos toda a informacao em uma determinada tabela
		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");


		}

		//vamos fazer agora um metodo list que busca um usuario 
		public static function search($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
					':SEARCH'=>"%".$login."%"
			));

			//basicamente ele pega oque eu digitar dentro dessa variavel login, penso eu que seja algo que se pareca "looks like" e utlizamos a expressao LIKE para isso, logo retornara que seja igual ao parametro $login que passarmos
		}

		public function login($login, $password){
			//a diferenca entre esse e o metodo "LoadById" e que nao vai ser mais por id, e vamos ter que passar por parametro o login e a senha, caso elas sejam iguais no db, setamos as variaveis com os valores de la, caso contrario jogamos uma execao 
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
					":LOGIN"=>$login,
					":PASSWORD"=>$password,
			));

			if(count($results) > 0){

				$this->setData($results[0]);

			} else {

				throw new Exception("Login e/ou senha invalidos.");
				

			}

		}

		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
		}

		public function insert(){

			$sql = new Sql();

			//essa call esta chamando uma procedor "storage procedor_tabela_inserir(), essa e o nosso parametro raw query do metodo select, e dentro da raw passamos dois parametros
			//precisamos criar essa procedure no banco de dados, se fosse SQL server seria execute
			//utilizamos o metodo "LAST_INSERT_ID" na criacao da procedure no db, para trazer o ultimo id inserido nele 
			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
					':LOGIN'=>$this->getDeslogin(),
					':PASSWORD'=>$this->getDessenha()
			));

			if(count($results) > 0) {
				$this->setData($results[0]);
			}



		}
		//fizemos uma function construct para passar como parametro os dados a serem inseridos no db atraves do metodo insert e colocamos como = null para nao afetar outros metodos da classe usuario
		public function __construct($login = "",$password = ""){
			$this->setDeslogin($login);
			$this->setDessenha($password);
		}

		public function update($login,$password){

			$this->setDeslogin($login);
			$this->setDessenha($password);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
				':LOGIN'=>$this->getDeslogin(),
				':PASSWORD'=>$this->getDessenha(),
				':ID'=>$this->getIdusuario()
			));
		}

		public function delete(){

			$sql = new Sql();

			$sql->query("DELETE FROM tb_usuarios WHERE idusuario = 
				:ID", array(
					':ID'=>$this->getIdusuario()
			));

			$this->setDeslogin("");
			$this->setDessenha("");
			$this->setIdusuario(0);
			$this->setDtcadastro(new DateTime());

		}


	}


  ?>