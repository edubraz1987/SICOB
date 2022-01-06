<html>
	<title>Sistema de Consolidação de Boletins</title>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<script src="scripts/scripts.js"></script>
		<?php
		session_start();
		
		header('Content-Type: text/html; charset=utf-8');

		$con= mysql_connect("localhost","root","");
		$db= mysql_select_db("sicob");

		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
					
		$logado = isset($_SESSION['logado'] ) ? $_SESSION['logado']  : '0';
		
		if($logado==1){			
			echo '
			<script type="text/javascript">	
				//alert("Boletim!");
				window.location="../crud/principal.php";
			</script>';
		}
		else{
			session_destroy();
			echo '
			<script type="text/javascript">	
				//alert(" Não entrou!");
			</script>';
		?>
	</head>
	<body class="login">
		<div class="login" align="center" valign="left" height="800px">
			<form name="login" method="post" action="control/confirmar_login.php">
				<table border="0"  class="login">
					<tr>
						<td rowspan="6" width="80" align="center"><a href="index.php"><img id="logouerj2" src="img/logo_uerj_branco.png"></a></td>
					</tr>
					<tr>
						<td width="50"><b>Login:</b></td>
						<td width="100"><input name="login" type="text" id="login"></td>
					</tr>
					<tr>
						<td><b>Senha:</b></td>
						<td><input name="senha" type="password" id="senha"></td>
					</tr>
					<tr>
						<td colspan="2">
						<div align="center">
						<b><input align="center" name="entrar" type="submit" id="entrar" value="Entrar"></b>
						</div></td>
					</tr>
					<tr>
						<td colspan="2" align="center" ><a class="linque" href="index.php" target="_top">Página inicial</a> | 
						<a class="linque" href="https://goo.gl/forms/Ab9HcxgsZ4T7rt972" target="_blank">Solicitar Acesso</a></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
<?php
	}
?>
</html>