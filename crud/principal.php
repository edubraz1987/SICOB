<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<?php
		session_start();
		
		$usuario = isset($_SESSION['usuario'] ) ? $_SESSION['usuario']  : '';
		if ($usuario<>""){
			$login=1;
		}
		
		header('Content-Type: text/html; charset=utf-8');

		$con= mysql_connect("localhost","root","");
		$db= mysql_select_db("sicob");

		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script src="../scripts/scripts.js">
			var myWindow;
			
			myWindow = window.self;
		</script>
		<script language="JavaScript">
			function goBack(){
				window.history.back()
			}
			var login = "<?php echo $login; ?>";
			//alert (login);
		</script>
	</head>
		
	<title>SISTEMA DE CONSOLIDAÇÃO DE BOLETINS</title>
	<body class="checked" onload="mudaCorSublink1();abrirCadConv(login);">
		<div class="topsubmenu">		
			<ul>
				<li class="logado"><a href="" id="sublink1" class="linksmenu" onclick="mudaCorSublink1();abrirCadConv(login);">CONVÊNIO</a></li>
				<li class="logado"><a href="#" id="sublink2" class="linksmenu" onclick="mudaCorSublink2();abrirCadFin(login);">FINANCEIRO</a></li>
				<li class="logado"><a href="#" id="sublink3" class="linksmenu" onclick="mudaCorSublink3();abrirCadHupe(login);">HUPE</a></li>
				<li class="logado"><a href="#" id="sublink4" class="linksmenu" onclick="mudaCorSublink4();abrirCadCepu(login);">CEPUERJ</a></li>
				<li class="logado"><a href="#" id="sublink5" class="linksmenu" onclick="deslogar();">DESLOGAR (<?php echo $usuario;?>)</a></li>
			</ul>
		</div>
		<iframe id="fra_principal" name="fra_principal" src="" frameborder="0" height="650px" width="100%"></iframe>
	</body>
</html>