<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="/bin/css/estilos.css">
		<script src="bin/scripts/scripts.js"></script>
		<script language="JavaScript">
			function show(){
				 document.location.href ="../../../index.php";
			}
		</script>
		
	</head>
	<body class="loggout">
		<?php
		
		if (!isset($_GET['login']) || ($_GET['login']=="")){
			$_login="recuperarSenha";
				}
		else{
			$_login=$_GET['login'];
		}
		if($_login=="recuperarUsuario")
		{?>
			<form name="login" method="post" action="recuperar_senha.php">
				<table border="0" cellspacing="0" cellpadding="0" align='center' class="login2">
					<tr>
						<td colspan='3' align='center'><font color='#0081c9' size='4'><b>Recupera&#231;&#227;o de Login:</b></font></td>
					</tr>
					<tr>				
						<td align='right' ><b>CPF:</b></td>
						<td ><input name="cpf" type="text" id="cpf" size="20"></td>
					</tr>
					<tr>
						<td ><b>Primeiro Nome:</b></td>
						<td ><input name="nome" type="text" id="nome" size="20"></td>
					</tr>
					<tr>
						<td align="right"><input type='button' onclick='show();' value='Cancelar'></td>
						<td align="left">
							<b><input align="center" name="recupera_login" type="submit" id="recupera_login" value="Recuperar Login" ></b>
						</td>
					</tr>
				</table>
			</form>		
		<?php
		}
		else{?>
		<form name="login" method="post" action="recuperar_senha.php">
			<table border="0" cellspacing="0" cellpadding="0" align='center' class="login2">
				<tr>
					<td colspan='3' align='center'><font color='#0088c9' size='3'><b>Recupera&#231;&#227;o de senha:</b></font></td>
				</tr>
				<tr>				
					<td><b>Digite seu CPF:</b></td>
					<td><input name="cpf" type="text" id="cpf" size="20"></td>
				</tr>
				<tr>
					<td align='150%'><font color='#d2e8f5' size='1'>&npbs;</font></td>
					<td align='center'><font color='#0088c9' size='1'>apenas numeros</font></td>
				</tr>
				<tr>
					<td align="right"><input type='button' onclick='show();' value='Cancelar'></td>
					<td align="left"><b><input align="center" name="recupera_senha" type="submit" id="recupera_senha" value="Recuperar Senha" ></b></td>
				</tr>
				<tr>
					<td colspan="3"  align="center" ><a href="recuperar_senha.php?login=recuperarUsuario">Esqueci meu usu&#225;rio de acesso</a></td>
				</tr>
			</table>
		</form>
		<?php 
		}?>
	</body>
</html>