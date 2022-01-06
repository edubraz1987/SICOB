<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="/css/estilos.css">
		<script src="/scripts/scripts.js"></script>
	</head>
	<body>
	<?php 
		$con = mysql_connect('localhost','root','root');
		$basedados = mysql_select_db('siscondep');
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		
		session_start();
		
		$validacao = isset($_SESSION['validacao'] ) ? $_SESSION['validacao']  : '0';
		$tipo = isset($_SESSION['tipo'] ) ? $_SESSION['tipo']  : '';
		$situacao="";
		
		if (($validacao == "1")&&($tipo=="C"))
		{
			$id_usuario = $_GET["id_usuario"];
			
			//echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('$id_usuario');</script>";			
			
			$sql_inativo="SELECT situacao FROM login WHERE id_usuario=$id_usuario";
			$rs_inativo=mysql_query($sql_inativo);			
			
			while ($linha_inativo=mysql_fetch_array($rs_inativo)) {
				$situacao=$linha_inativo['situacao'];
				$situacao=strtoupper($situacao);
		    }
			//echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('$situacao');</script>";
			if ($situacao=="ATIVO"){
				mysql_query("UPDATE login set situacao='INATIVO' WHERE id_usuario = $id_usuario");
				mysql_close($con);
				echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('Usuário desativado. Para excluí-lo clique em excluir novamente!');location.href='lista_usuarios.php';</script>";
			}
			else if($situacao=="INATIVO"){
				mysql_query("DELETE FROM login WHERE id_usuario = $id_usuario");
				mysql_close($con);
				echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('Usuário excluído com sucesso!');location.href='lista_usuarios.php';</script>";
			}	
			else {
				mysql_close($con);
				echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('Erro ao processar a operação!');location.href='lista_usuarios.php';</script>";
			}
			
		}
		else{			
			echo("<script type='text/javascript'> alert('Não permitido!');voltar();</script>");	
		}
			
		
		
		
		
	?>
	</body>
</html>