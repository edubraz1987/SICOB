 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
		<script src="../../scripts/scripts.js"></script>
		<script language="JavaScript">
			function goBack(){
				window.history.back()
			}
			
		</script>
		<?php
		session_start();

		$validacao = isset($_SESSION['validacao'] ) ? $_SESSION['validacao']  : '0';
		$tipo = isset($_SESSION['tipo'] ) ? $_SESSION['tipo']  : '';
				
		//$id_usuario = $_GET["id_usuario"]; **** somente para o editar ****
		//$comando = $_GET["cmd"]; 			 **** somente para o editar ****
			
			//echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('$id_usuario');</script>";
		$con = mysql_connect('localhost','root','root');
		$basedados = mysql_select_db('siscondep');
		
		$metodo = isset($_GET['metodo']) ? $_GET['metodo'] : ""  ;
		
		
	if (($validacao == "1")&&($tipo=="C"))
	{
		if(($metodo<>"cadastrar")&&($metodo<>"alterar")){	
	?>
	
		</head>
		<body>
		<div class='form_usuario' align='center' valign='left'>
			<form name='usuario' method='post' action='cadastra_usuarios.php?metodo=cadastrar'>
				<table border='0' cellspacing='0' cellpadding='0' align='center'>
					<tr>
						<td colspan='8' align='center'><font color='gold' size='4'><p style='font-family: Lucida Sans Unicode; font-size:13pt;'><b>Cadastro de Usu&#225;rios</b></p></font></td>
					</tr>
					<tr>	
						<td colspan='8' align='center'>
							<br>
						</td>
					</tr>
					<tr>
						<td align='right'>
							Usuário:<input name='usuario' type='text' id='usuario' size='18'>
							Email:<input name='email' type='text' id='email' size='35'>
						</td>
					</tr>
					<tr>	
						<td colspan='8' align='center'>
							<br>
						</td>
					</tr>
					<tr>
						<td align='right'>Nome:<input name='nome' type='text' id='nome' size='24'>
										Matricula:<input  name='matricula' type='text' id='matricula' size='8'>
										Perfil:
										<select name='perfil' style='width: 80px'>
											<option value='A' selected>Aluno</option>
											<option value='P' >Professor</option>");
										</select>
							</td>
					</tr>
					<tr>	
						<td colspan='8' align='center'>
							<br>
						</td>
					</tr>
					
					<tr>	
						<td colspan='8' align='center'>
							<hr>
						</td>
					</tr>
					<tr>	
						<td colspan='8' rowspan='2' align='center'>
							<input type='button' value='Cancelar' onclick='goBack()'>
							<input align='center' name='cadastrar' type='submit' id='cadastrar' value='Cadastrar Usuário'>
						</td>
					</tr>
				</table>
			</form>
		</div>
	<?php
		
		}
		elseif($metodo=="cadastrar"){
			
			// ============ LOGIN ==========
			$usuario=$_POST['usuario'];
			$senha="123456AA";
			$perfil=strtoupper($_POST['perfil']);
			$situacao="ATIVO";
			
			$senha="123456AA";
			
			// ============ USUÁRIO ==========
			$nome=$_POST['nome'];
			$matricula=$_POST['matricula'];
			$email=$_POST['email'];
			
			
			if($usuario==""||$nome==""||$email==""||$matricula==""){
				echo("<script type='text/javascript'> alert('Todos os campos devem ser preenchidos!'); goBack();</script>");
			}
			else
			{
				$sql_login=("INSERT INTO login(id_usuario, usuario, senha, tipo, situacao) VALUES (NULL,'$usuario','$senha','$perfil','$situacao')");
				mysql_query($sql_login) or die(mysql_error());
				
				$sql_id=("select max(id_usuario) from login");
				$rs_id=mysql_query($sql_id);
				while ($linha_id=mysql_fetch_array($rs_id)) {
					$id_usuario=$linha_id[0];
				}
				
				if ($perfil=="A"){
					$status="CURSANDO";
					$sql_aluno=("INSERT INTO aluno(id_aluno, id_usuario, nome, matricula, email, status) VALUES (NULL,'$id_usuario','$nome','$matricula','$email','$status')");
					mysql_query($sql_aluno) or die(mysql_error());
				}
				else{
					$status="LESSIONANDO";
					$sql_professor=("INSERT INTO professor(id_professor, id_usuario, nome, matricula, email, status) VALUES (NULL,'$id_usuario','$nome','$matricula','$email','$status')");
					mysql_query($sql_professor) or die(mysql_error());
				}
				echo ("<script type='text/javascript'>alert('Registro inserido com sucesso!');location.href='lista_usuarios.php';</script>");
				
			}
		}
		elseif($metodo=="alterar"){
			
			//echo $metodo;
			
			
			$id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : ""  ;
			
			$usuario=$_POST['usuario'];
			$situacao=strtoupper($_POST['situacao']);
			$tipo=$_POST['tipo'];
			//$perfil=strtoupper($_POST['perfil']);
			//$situacao=strtoupper($_POST['tipo']);
			
			
			// ============ USUÁRIO ==========
			$nome=$_POST['nome'];
			$matricula=$_POST['matricula'];
			$email=$_POST['email'];
			$status=$_POST['status'];
			
			
			/*echo "<br>".$id_usuario."<br>";
			echo "<br>".$nome."<br>";
			echo "<br>perfil".$perfil."<br>";
			echo $matricula."<br>";
			echo $email."<br>";
			echo $status."<br>";*/

			
			if($usuario==""||$nome==""||$email==""||$matricula==""){
				echo("<script type='text/javascript'> alert('Todos os campos devem ser preenchidos!'); goBack();</script>");
			}
			else{
				
				$sql_atualiza_login=("UPDATE login SET usuario = '$usuario',situacao = '$situacao',tipo = '$tipo' WHERE id_usuario = '$id_usuario'");
				echo $sql_atualiza_login;
				mysql_query($sql_atualiza_login) or die(mysql_error());
				
				if($tipo=="A"){
					$sql=("UPDATE aluno SET nome = '$nome',matricula = '$matricula',email = '$email', status='$status' WHERE id_usuario = '$id_usuario'");
					//echo $sql."<br>";
					mysql_query($sql) or die(mysql_error());
					echo ("<script type='text/javascript'>alert('Registro atualizado com sucesso!');location.href='lista_usuarios.php';</script>");
					//echo ("<script type='text/javascript'>location.href='lista_usuarios.php';</script>");
					}
				else{
					$sql=("UPDATE professor SET nome = '$nome',matricula = '$matricula',email = '$email', status='$status' WHERE id_usuario = '$id_usuario'");					
					mysql_query($sql) or die(mysql_error());
					echo ("<script type='text/javascript'>alert('Registro atualizado com sucesso!');</script>");
					//echo ("<script type='text/javascript'>location.href='lista_usuarios.php';</script>");
				
				}
			}
		}
		else{
				//echo ("<script type='text/javascript'>alert('Errado!');</script>");
			}
		
						
			mysql_close($con);
	}
	else
	{
		mysql_close($con);
		echo("<script type='text/javascript'> alert('Não permitido!');location.href='index2.php';</script>");	
	}
		?>
</body>
</html>