<?php
	$host = "localhost";
	$user = "root";
	$pwd = "root";
	$banco = "bdagenda";
	$msgerro = "Conexao OK";
	
	$conexao = mysqli_connect($host, $user, $pwd, $banco);
	
	if (!$conexao)
	{
		$msgerro = "Problema com a conexao com o banco de dados";
	}
	
	else
	{
		//Abre o banco de dados
		mysqli_select_db($conexao, $banco);
	}
?>