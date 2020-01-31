<?php
	require_once("./conexao/dbConexao.php");
	
	$codigo = "";
	$nome = "";
	$email = "";
	$telefone = "";
	$cpf = "";
	$usuario = "";
	$senha = "";

	if ($_POST)
	{
		$acao = "";
		
		if (isset($_REQUEST["opcao"]))
		{
			$acao = $_REQUEST["opcao"];
		}
		
		//Recuperar os dados enviados pelo formulário
		$codigo = $_REQUEST["txtCodigo"];
		$nome = $_REQUEST["txtNome"];
		$email = $_REQUEST["txtEmail"];
		$telefone = $_REQUEST["txtTelefone"];
		$cpf = $_REQUEST["txtCpf"];
		$usuario = $_REQUEST["txtUsuario"];
		$senha = $_REQUEST["txtSenha"];
		
		if ($acao == "incluir")
		{
			$sqlstring = "select * from tlbagenda where agdid = " . $codigo;
			
			//Executar uma instrução SQL dentro do banco de dados
			$retorno = mysqli_query($conexao, $sqlstring);
			
			if (mysqli_affected_rows($conexao) > 0)
			{
				$msgerro = "Código existente!";
			}
			else
			{
				$sqlstring = "insert into tblagenda (agdid, agdnome, agdemail, agdtelefone, agdcpf, agdusuario, agdsenha) values (";
				$sqlstring .= "$codigo, '$nome', '$email', '$telefone', '$cpf', '$usuario', '$senha');";

				//Executar a instrução SQL no banco de dados
				$retorno = mysqli_query($conexao, $sqlstring);
				if ($retorno)
				{
					$msgerro = "Registro incluído com sucesso!";
				}
				else
				{
					$msgerro = "Problema na inclusão do registro!";
				}
			}
		}
		
		else if ($acao == "consultar")
		{
			//Criar a instrução SQL para buscar o código digitado no formulário
			$sqlstring = "select * from tblagenda where agdid = " . $codigo;
			
			//Executar uma instrução SQL dentro do Banco de Dados
			$retorno = mysqli_query($conexao, $sqlstring);
			
			//Verificar se o código pesquisado existente
			if (mysqli_affected_rows($conexao) == 0)
			{
				$msgerro = "Código inexistente";
			}
			
			else
			{
				$registro = mysqli_fetch_array($retorno);
				
				$codigo = $registro["agdid"];
				$nome = $registro["agdnome"];
				$email = $registro["agdemail"];
				$telefone = $registro["agdtelefone"];
				$cpf = $registro["agdcpf"];
				$usuario = $registro["agdusuario"];
				$senha = $registro["agdsenha"];
			}
		}
		
		else if ($acao == "limpar")
		{
			$codigo = "";
			$nome = "";
			$email = "";
			$telefone = "";
			$cpf = "";
			$usuario = "";
			$senha = "";
		}
		
		else if ($acao == "alterar")
		{
			//Criar a instrução SQL para buscar o código digitado no formulário
			$sqlstring = "select * from tblagenda where agdid = " . $codigo;
			
			//Executar uma instrução SQL dentro do Banco de Dados
			$retorno = mysqli_query($conexao, $sqlstring);
			
			//Verificar se o código pesquisado existente
			if (mysqli_affected_rows($conexao) == 0)
			{
				$msgerro = "Código inexistente";
			}
			
			else
			{
				$sqlstring = "update tblagenda set ";
				$sqlstring .= "agdnome = '" . $nome . "',";
				$sqlstring .= "agdemail = '" . $email . "',";
				$sqlstring .= "agdtelefone = '" . $telefone . "',";
				$sqlstring .= "agdcpf = '" . $cpf . "',";
				$sqlstring .= "agdusuario = '" . $usuario . "',";
				$sqlstring .= "agdsenha = '" . $senha . "'";
				$sqlstring .= "where agdid = " . $codigo;	
				
				//Executar a instrução SQL no banco de dados
				$retorno = mysqli_query($conexao, $sqlstring);
				if ($retorno)
				{
					$msgerro = "Registro alterado com sucesso!";
				}
				else
				{
					$msgerro = "Problema na alteração do registro!";
				}
			}
		}
		
		else if ($acao == "excluir")
		{
			//Criar a instrução SQL para buscar o código digitado no formulário
			$sqlstring = "select * from tblagenda where agdid = " . $codigo;
			
			//Executar uma instrução SQL dentro do Banco de Dados
			$retorno = mysqli_query($conexao, $sqlstring);
			
			//Verificar se o código pesquisado existente
			if (mysqli_affected_rows($conexao) == 0)
			{
				$msgerro = "Código inexistente";
			}
			
			else
			{
				$sqlstring = "delete from tblagenda where agdid =" . $codigo;
				
				
				//Executar a instrução SQL no banco de dados
				$retorno = mysqli_query($conexao, $sqlstring);
				if ($retorno)
				{
					$msgerro = "Registro excluído com sucesso!";
				}
				else
				{
					$msgerro = "Problema na exclusão do registro!";
				}
			}
		}
	}
?>

<html>

	<head>
	
		<title> Banco de Dados com PHP </title>
	
		<link rel="stylesheet" type="text/css" href="./css/estilos.css">
		
		<script language="javascript" type="text/javascript">
		
			function fnValidarDados(acao)
			{
				if (document.frmBancoDados.txtCodigo.value == '')
				{
					alert('Campo do código obrigratório!');
					document.frmBancoDados.txtCodigo.focus();
				}
				
				else
				{
					if ((acao == 'incluir') || (acao == 'alterar'))
					{
						if (document.frmBancoDados.txtNome.value == '')
						{
							alert('Campo Nome obrigratório!');
							document.frmBancoDados.txtNome.focus();
						}
						
						else if (document.frmBancoDados.txtEmail.value == '')
						{
							alert('Campo E-Mail obrigratório!');
							document.frmBancoDados.txtEmail.focus();
						}
						
						else if (document.frmBancoDados.txtTelefone.value == '')
						{
							alert('Campo Telefone obrigratório!');
							document.frmBancoDados.txtTelefone.focus();
						}
						
						else if (document.frmBancoDados.txtCpf.value == '')
						{
							alert('Campo CPF obrigratório!');
							document.frmBancoDados.txtCpf.focus();
						}
						
						else if (document.frmBancoDados.txtUsuario.value == '')
						{
							alert('Campo Usuario obrigratório!');
							document.frmBancoDados.txtUsuario.focus();
						}
						
						else if (document.frmBancoDados.txtSenha.value == '')
						{
							alert('Campo Senha obrigratório!');
							document.frmBancoDados.txtSenha.focus();
						}
					}
				
					document.frmBancoDados.action = './index.php?opcao='+acao;
					document.frmBancoDados.submit();
				}
				
				return false;
			}

		</script>
		
	</head>
	
	<body>
	
	<form name="frmBancoDados" method="post" action="">
		
		<table class="tlbPrincipal" width="1000px" border="0" cellpadding="0" cellspacing="0">
			
			<?php 

				require_once("./pages/frmTitulo.php");
				require_once("./pages/frmMenu.php");
				require_once("./pages/frmMensagemErro.php");
				require_once("./pages/frmFormulario.php");
				require_once("./pages/frmRodape.php");
			?>
		
		</table>
		
		
	</form>
	
	</body>
</html>