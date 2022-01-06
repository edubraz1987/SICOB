<html>
	<title>UNIVERSIDADE DO ESTADO DO RIO DE JANEIRO</title>
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
		
		?>
	</head>
	
	<body class="login">
		<div class="topbar" id="containertopo" align="center">
			<div class="topbar" id="titulo" align="center">
				<img id="logouerj" src="img/logo_uerj_branco.png"></img>
				<label id="containerlabel" >SISTEMA DE EXTRATOS </label>
			</div>
		</div>
		<div class="geral" align="center" >
			<div class="indexextratos" >
				<table class="botao3" border="0" width="" align="center"height="100%">
					<tr >
						<td align="center" ><a class="linq" href="http:\\dicre-extrato\">INSERIR EXTRATOS <BR> CONVÊNIO/FINANCEIRO</a></td>
					</tr>
				</table>
			</div>		
			<div class="indexextratos2" align="center" >
				<table class="botao3" border="0" align="center" valign="left" height="100%">
					<tr >
						<td valign="left" align="center"><a class="linq" href="http:\\dicre-boletim\">VISUALIZAR EXTRATOS <BR> CONVÊNIO/FINANCEIRO</a></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="geral2" align="center" >
			<div class="indexextratos3" valign="center">
				<table class="botao3" border="0" width="" align="center"  height="100%">
					<tr>
						<td align="center" ><a class="linq" href="http:\\dicre-extrato\">INSERIR EXTRATOS <BR><BR>CEPUERJ | EDUERJ<BR> IMPORTAÇÃO | HUPE</a></td>
					</tr>
				</table>
			</div>		
			<div class="indexextratos4" align="center">
				<table class="botao2" border="0" align="center" valign="left" height="100%" width="100%">
					<tr >
						<td valign="left" align="center"><a class="linq" href="http:\\dicre-boletim\">CEPUERJ</a></td>
					</tr>
					<tr>
						<td valign="left" align="center"><hr></td>
					</tr>
					<tr>
						<td valign="left" align="center"><a class="linq" href="http:\\dicre-boletim\">EDUERJ </a></td>
					</tr>
					<tr>
						<td valign="left" align="center"><hr></td>
					</tr>
					<tr>
						<td valign="left" align="center"><a class="linq" href="http:\\dicre-boletim\">IMPORTAÇÃO </a></td>
					</tr>
					<tr>
						<td valign="left" align="center"><hr></td>
					</tr>
					<tr>
						<td valign="left" align="center"><a class="linq" href="http:\\dicre-boletim\">HUPE </a></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="geral3" align="center" >
			<div class="indexextratos5" >
				<table class="botao3" border="0" width="" align="center"height="100%">
					<tr >
						<td align="center" ><a class="linq" href="http:\\dicre-extrato\">RENDIMENTOS</a></td>
					</tr>
				</table>
			</div>		
		</div>
		<div class="geral4" align="center" >
			<div class="indexextratos6" >
				<table class="botao3" border="0" width="" align="center"height="100%">
					<tr >
						<td align="center" ><a class="linq" href="http:\\dicre-boletim\novo_index.php">VOLTAR</a></td>
					</tr>
				</table>
			</div>		
		</div>
	</body>

</html>