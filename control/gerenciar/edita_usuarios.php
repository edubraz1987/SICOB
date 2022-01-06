<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
		<script src="/scripts/scripts.js"></script>
		<script language="JavaScript">
			function goBack(){
				window.history.back()
			}
		</script>
	</head>
	<body>
	<?php 				
		session_start();

			$validacao = isset($_SESSION['validacao'] ) ? $_SESSION['validacao']  : '0';
			$tipo = isset($_SESSION['tipo'] ) ? $_SESSION['tipo']  : '';
					
			$id_usuario = $_GET["id_usuario"];
			$comando = $_GET["cmd"];
				
				//echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('$id_usuario');</script>";
				
				
				$con = mysql_connect('localhost','root','root');
				$basedados = mysql_select_db('siscondep');

				if ($comando=="excluir"){
				?>
				<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>
					decisao = confirm('Tem certeza que deseja excluir este usuario?');
					
					if (decisao)
					{
						location.href='excluir_usuarios.php?id_usuario=<?=$id_usuario;?>';
					} 
					else 
					{
						location.href='lista_usuarios.php';
					}
				</SCRIPT>
				
				<?php
				}
				else if ($comando=="resetar"){
					mysql_query("UPDATE login set senha='123456AA' WHERE id_usuario = $id_usuario");
					mysql_close($con);
					echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('Senha resetada com sucesso!');location.href='lista_usuarios.php';</script>";
			
				}
				else{ //estrutura do editar
					$contador=0;
					
					$sql="SELECT id_usuario, usuario, tipo, situacao FROM login WHERE id_usuario='$id_usuario'";
					$rs=mysql_query($sql);
							
						
					/*echo $sql ."</br>";
					echo $cnpj;*/
				$nome="";
				$matricula="";
				$email="";
				$status="";
				
				while ($linha=mysql_fetch_array($rs)) {
										
						$id_usuario=$linha['id_usuario'];
						$usuario=$linha['usuario'];
						$tipo=$linha['tipo'];
						$situacao=$linha['situacao'];
						
						
					if ($tipo=="A"){
						$sql_aluno="SELECT nome, matricula, email, status FROM aluno WHERE id_usuario='$id_usuario'";
						$rs_aluno=mysql_query($sql_aluno);
					
						//echo $sql_aluno;
					
						while ($linha_aluno=mysql_fetch_array($rs_aluno)) {
							
							$nome=$linha_aluno['nome'];
							$matricula=$linha_aluno['matricula'];
							$email=$linha_aluno['email'];
							$status=$linha_aluno['status'];
						
						}
					}
					else if ($tipo=="P"){
						$sql_professor="SELECT nome, matricula, email, status FROM professor WHERE id_usuario='$id_usuario'";
						$rs_professor=mysql_query($sql_professor);
					
						//echo $sql_professor;
						
						while ($linha_professor=mysql_fetch_array($rs_professor)) {
					
						$nome=$linha_professor['nome'];
						$matricula=$linha_professor['matricula'];
						$email=$linha_professor['email'];
						$status=$linha_professor['status'];
							
						}
					}					
							echo ("<div class='form_usuario' align='center' valign='left'>
						<form name='usuario' method='post' action='cadastra_usuarios.php?metodo=alterar&id_usuario=$id_usuario'>
							<table border='0' cellspacing='0' cellpadding='0' align='center'>
								<tr>
									<td colspan='8' align='center'><font color='gold' size='4'><p style='font-family: Lucida Sans Unicode; font-size:13pt;'><b>Atualizacao de Usu&#225;rios</b></p></font></td>
								</tr>
								<tr>
									<td align='right'>Usuário:</td>
									<td ><input name='usuario' type='text' id='usuario' value='$usuario' size='20'></td>
									<td  align='right'>Email:</td>
									<td colspan='4'><input name='email' value='$email' type='text' id='email' size='25'></td>
								</tr>
								<tr>
									
									
									<td align='right'>Perfil:</td>
									<td align='left'>
										<select name='tipo' style='width: 155px'>");
										if($tipo=="A"){
										  echo ("
											  <option value='A' selected>Aluno</option>
											  <option value='P' >Professor</option>");
											  }
										 else{
											  echo ("
											  <option value='A' >Aluno</option>
											  <option value='P' selected>Professor</option>");
										  }
										 echo ("</select>
									</td>
									
									<td align='right'>Login:</td>
									<td align='left'>
										<select name='situacao' style='width: 155px'>");
										if($situacao=="ativo"){
										  echo ("
											  <option value='ativo' selected>ATIVO</option>
											  <option value='inativo'>INATIVO</option>");
											  }
										 else{
											  echo ("
											  <option value='ativo' >ATIVO</option>
											  <option value='inativo' selected>INATIVO</option>");
										  }
										 echo ("</select>
									</td>
								</tr>
								<tr>
									<td align='right'>Nome:</td>
									<td colspan='4'><input name='nome' type='text' id='nome' value='$nome' size='60'></td>
								</tr>
								<tr>
									<td align='right'>Matricula:</td>
									<td ><input  name='matricula' type='text' value='$matricula' id='matricula' size='20'></td>
									
									<td align='right'>status:</td>
									<td  width='40'><input name='status' type='text' value='$status' id='status' size='10'></td>
								</tr>
								<tr>	
									<td colspan='8' align='center'>
										<hr>
									</td>
								</tr>
								<tr>	
									<td colspan='8' rowspan='2' align='center'>
										<input type='button' value='Cancelar' onclick='goBack()'>
										<input align='center' name='Atualizar' type='submit' id='atualizar' value='Atualizar Usuário'>
									</td>
								</tr>
								
							</table>
						</form></div>");
						
						
						
						
						
				}
						
					
			}
			mysql_close($con);
			
		?>
</body>
</html>