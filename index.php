<?php

	require_once("config.php");


	//carega um usuario
	//$user = new Usuario();
	//$user->loadById(3);
	//echo $user;

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//carrega uma lista de usuarios
	//$lista = Usuario::getList();
	//echo json_encode($lista);

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	//carrega uma lista de usuarios buscando pelo login
	//estamos basicamente falando,"traga-nos todos os usuarios que tem as palavras "ro" no login, no caso de nosso banco de dados ira retornar apenas o usuario root, uma vez que todos os outro comecam com GU
	//$search = Usuario::search("ro");
	//echo json_encode($search);

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	//carrega um usuario usando o login e a senha
	//temos que passar a informacao de um login que coincide com a senha daquela linha no db
	//$usuario = new Usuario();
	//$usuario->login("root","#*#N(!");
	//echo $usuario;

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//criando um novo usuario atraves do insert
	//$aluno = new Usuario("aluno","@lun0");
	//$aluno->insert();
	//echo $aluno;

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//$usuario = new Usuario();
	//como setamos o usuario como 5, ele vai fazer update no usuario de numero 5
	//$usuario->loadById(5);
	//$usuario->update("professor","19823rbgn");
	//echo $usuario;

  ?>