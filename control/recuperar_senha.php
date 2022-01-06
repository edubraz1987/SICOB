<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script src="../scripts/scripts.js"></script>
		<script language="JavaScript">
			function show(){
				 document.location.href ="../index2.php";
			}
			function goBack(){
				window.history.back()
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
		//echo("<script type='text/javascript'> alert('$_login');</script>");
		if($_login=="recuperarUsuario")
		{?>
			<script type='text/javascript'> alert('Favor entrar em contato com a coordenação!'); show();</script>		
		
		<?php
		}
		else if($_login=="recuperarSenha")
		{
?>		<div class="login2" align="center" >
		<form name="login" method="post" action="recuperar_senha.php?login=enviausuario">
			<table border="0" cellspacing="0" cellpadding="0" align='center' >
				<tr>
					<td colspan='3' align='center'><font color='#FFF' size='4'><b>Recuperação de senha:</b></font></td>
				</tr>
				<tr>				
					<td><font color='GOLD'><b>Digite seu usuário:</b></FONT></td>
					<td><input name="usuario" type="text" id="usuario" size="20"></td>
				</tr>
				<tr>				
					<td><font color='gold'><b>Tipo de acesso:</b></font></td>
					<td>
						<select name="tipo">
							<option value="A">Aluno</option>
							<option value="P">Professor</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=2><hr></td>
				</tr>
				<tr>
					<td align="right"><input type='button' onclick='show();' value='Cancelar'></td>
					<td align="left"><b><input align="center" name="recupera_senha" type="submit" id="recupera_senha" value="Recuperar Senha" ></b></td>
				</tr>
				<tr>
					<td colspan="3"  align="center" ><a class="linque" href="recuperar_senha.php?login=recuperarUsuario">Esqueci meu usu&#225;rio de acesso</a></td>
				</tr>
			</table>
		</form>
		
	<?php 
		}
		else if($_login=="enviausuario"){
		
			$con = mysql_connect('localhost','root','root');
			$basedados = mysql_select_db('siscondep');
			
			
			$usuario = isset($_POST['usuario'] ) ? $_POST['usuario']  : '';
			$tipo=$_POST['tipo'];
			
			if ($tipo=="A"){
				$sql_login="SELECT email FROM aluno,login WHERE login.id_usuario = aluno.id_usuario and user = '$usuario'";
				$rs_login = mysql_query($sql_login);
			}
			else if($tipo=="P"){
				$sql_login="SELECT email FROM professor,login WHERE login.id_usuario = professor.id_usuario and user = '$usuario'";
				$rs_login = mysql_query($sql_login);
			}
			
			if (mysql_affected_rows()==0){
				echo("<script type='text/javascript'> alert('Usuário nao encontrado!'); goBack();</script>");
			}
			else{	?>
			<div class="login2" align="center" >
				<form name="login" method="post" action="recuperar_senha.php?login=enviaemail">
					<table border="0" cellspacing="0" cellpadding="0" align='center' >
						<tr>
							<td colspan='3' align='center'><font color='#fff' size='4'><b>Recuperação de senha:</b></font></td>
						</tr>
						</tr>
							<td ><br></td>
						<tr>
						<tr>				
							<td><font color='gold'><b>Email:</b></font></td>
							<td><input name="email" type="text" id="email" size="30"></td>
							<td><input name="tipo" type="hidden" id="tipo" value="<?=$tipo?>" size="1"></td>
							<td><input name="usuario" type="hidden" id="usuario" value="<?=$usuario?>" size="1"></td>
						</tr>
							<td colspan='2'><br><hr></td>
						<tr>						
							<td align="center" colspan='2'><input type='button' onclick='show();' value='Cancelar'><b>
							<input align="center" name="recupera_senha" type="submit" id="recupera_senha" value="Continuar" ></b></td>
						</tr>
					</table>
				</form>
	<?php
			}
			mysql_close($con);
		}
		else if($_login=="enviaemail"){
			
			$email=isset($_POST['email'] ) ? $_POST['email']  : '';
			$usuario = isset($_POST['usuario'] ) ? $_POST['usuario']  : '';
			$tipo=isset($_POST['tipo'] ) ? $_POST['tipo']  : '';
			
			$con = mysql_connect('localhost','root','root');
			$basedados = mysql_select_db('siscondep');
			
			if($tipo=="A"){
				$sql_senha="SELECT email FROM aluno,login WHERE email = '$email' and usuario='$usuario' ";
				$rs_senha = mysql_query($sql_senha);
			}
			else{
				$sql_senha="SELECT email FROM professor,login WHERE email = '$email' and usuario='$usuario' ";
				$rs_senha = mysql_query($sql_senha);
			}
			
			//echo $sql_senha;
			
			
			if (mysql_affected_rows()==0){
				echo("<script type='text/javascript'> alert('Email incorreto ou não encontrado na nossa base de dados!'); goBack();</script>");
			}
			else{
				echo("<script type='text/javascript'> alert('Sua senha será enviada para o e-mail $email'); show();</script>");
			}
			mysql_close($con);
		}
	
	else{
	?>
		<script type='text/javascript'> alert('Não permitido!'); show();</script>
	<?php
	}
	?></div>
	</body>
</html>