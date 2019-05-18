<?php

	require_once("config.php");

	$user = new Usuario();

	$user->loadById(3);

	echo $user;
	

  ?>