<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
		<script src="../../scripts/scripts.js"></script>
	</head>
	<body>
		<form name="consulta" method="post" action="lista_usuarios.php">
			<table border="0" cellspacing="0" cellpadding="0" align='center' class="pesquisa">
					<td colspan="3" align="center">
						<input align="center" name="consultar" type="submit" id="consultar" value="Atualizar" >
						<input align="center" type="button" onclick="window.location='cadastra_usuarios.php';" value="Novo Usuário" >
					</td>
				</tr>
			</table>
		</form>
		<hr>		
	<?php
		
		header('Content-Type: text/html; charset=utf-8');
	
		$con= mysql_connect("localhost","root","root");
		$db= mysql_select_db("siscondep");
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		
		session_start();
		
		$validacao = isset($_SESSION['validacao'] ) ? $_SESSION['validacao']  : '0';
		$tipo = isset($_SESSION['tipo'] ) ? $_SESSION['tipo']  : '';
		
		//echo("<script type='text/javascript'> alert('$validacao | $tipo');</script>");
		
		if (($validacao == "1")&&($tipo=="C"))
		{	
		
		$contador=0;
					
			$sql="SELECT id_usuario, usuario, tipo, situacao FROM login order by usuario";
			$rs=mysql_query($sql);
			$vazio=mysql_affected_rows();
			
			if ($vazio==-1){
				echo "<table width='100%'>
					<tr bgcolor='#d2e5ff'><tr>
					<td align='center' colspan='10' bgcolor='#dddddd'>N&#227;o existem usu&#225;rios cadastrados!</td>
					</tr>
				</table>";
			}
			else
			{
				?>
				<table width="100%" >
					<tr bgcolor="#005588" style="color:white; font-family:Cambria;" align="center">
						<td>Linha</td>
						<td>Nome</td>
						<td>Matricula</td>
						<td>Email</td>
						<td>Usuário</td>
						<td>Tipo</td>
						<td>Situação</td>						
						<td>Reset</td>
						<td>Editar</td>
						<td>Excluir</td>
						
					</tr>
				<?php 
				
				while ($linha=mysql_fetch_array($rs)) {
				
					$id_usuario=$linha['id_usuario'];
					$usuario=$linha['usuario'];
					if($linha['tipo']=='A'){
						$tipo_usuario=$linha['tipo'];						
						$tipo_usuario2="ALUNO";						
					}else if($linha['tipo']=='P'){
						$tipo_usuario=$linha['tipo'];						
						$tipo_usuario2="PROFESSOR";						
					}else if($linha['tipo']=='C'){
						$tipo_usuario=$linha['tipo'];						
						$tipo_usuario2="ADMINISTRADOR";						
					}else{
						$tipo_usuario2="N/D";						
					}
					
					//echo("<script type='text/javascript'> alert('$tipo_usuario');</script>");
					
					$situacao=strtoupper($linha['situacao']);
						
					
					if($tipo_usuario=="A"){
						$sql_usuario="SELECT nome, matricula, email FROM aluno WHERE id_usuario=$id_usuario";
						$rs_usuario=mysql_query($sql_usuario);
						
						while ($linha_usuario=mysql_fetch_array($rs_usuario)) {
							$nome=$linha_usuario['nome'];
							$matricula=$linha_usuario['matricula'];
							$email=$linha_usuario['email'];
						}
					}
					else if($tipo_usuario=="P"){
						$sql_usuario="SELECT nome, matricula, email FROM professor WHERE id_usuario=$id_usuario";
						$rs_usuario=mysql_query($sql_usuario);
						
						while ($linha_usuario=mysql_fetch_array($rs_usuario)) {
							$nome=$linha_usuario['nome'];
							$matricula=$linha_usuario['matricula'];
							$email=$linha_usuario['email'];
						}
						
					}
					else if($tipo_usuario=="C"){
						$nome="-----";
						$matricula="-----";
						$email="siscondep@gmail.com";
						
					}
					else{
						echo("<script type='text/javascript'> alert('Não permitido!');</script>");
					}
					//$nome=$linha['nome'];
					//$email=$linha['email'];
					//$cpf=$linha['cpf'];
					//$setor=$linha['setor'];
					//$perfil_usu=$linha['perfil'];
					//$logado=$linha['logado'];
					
					$contador=$contador+1;
					if ($contador%2==0){
						$cor="#dddddd";
					}
					else{
						$cor="#ffffff";
					}
					echo "
					<tr bgcolor='$cor'>
						<td>$contador</td>
						<td>$nome</td>
						<td>$matricula</td>
						<td>$email</td>
						<td>$usuario</td>
						<td>$tipo_usuario2</td>
						<td>$situacao</td>
						<td align='center'><a href='edita_usuarios.php?id_usuario=$id_usuario&cmd=resetar' ><img src='../../img/reset.png' width='20' height='20'></a></td>
						<td align='center'><a href='edita_usuarios.php?id_usuario=$id_usuario&cmd=editar' ><img src='../../img/editar.png' width='20' height='20'></a></td>
						<td align='center'><a href='edita_usuarios.php?id_usuario=$id_usuario&cmd=excluir' ><img src='../../img/excluir.png' width='20' height='20'></a></td>
					</tr>";
					
				}
				echo "</table>";	
			}
			mysql_close($con);
		}
		else{
			mysql_close($con);
			echo("<script type='text/javascript'> alert('Não permitido!');voltar();</script>");	
		}
		
		?>
</body>
</html>