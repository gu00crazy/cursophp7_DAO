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
	$usuario = new Usuario();
	$usuario->login("root","#*#N(!");
	echo $usuario;

  ?>