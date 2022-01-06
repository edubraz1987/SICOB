<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
		session_start();
		
		header('Content-Type: text/html; charset=iso-8859-1');
	
		$con= mysql_connect("localhost","root","");
		$db= mysql_select_db("sicob");
		
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		
		$usuario = isset($_SESSION['usuario'] ) ? $_SESSION['usuario']  : '';
		$hoje = date('Y-m-d',strtotime("-1 day"));
		$ano = date('Y');
		
		$_SESSION['tipo'] = "cepuerj";
		
		$sql_pesquisa = "select max(boletim) as ultimo from cepuerj where ano =$ano";
		$rs_pesquisa = mysql_query($sql_pesquisa);
		
		if (mysql_affected_rows()==0){
			$proximo_boletim = "001";
		}
		else
		{
			while ($linha_pesquisa=mysql_fetch_array($rs_pesquisa)) {
				
				$ultimo_boletim=$linha_pesquisa['ultimo'];
				//$ultimo_boletim = str_pad($ultimo_boletim, 3, '0', STR_PAD_LEFT);
				
				$proximo_boletim = $ultimo_boletim+1;
				$proximo_boletim = str_pad($proximo_boletim, 3, '0', STR_PAD_LEFT);
				
				//echo $ultimo_boletim;
			}
		}
		
		//echo("<script type='text/javascript'> alert('$validacao | $tipo');</script>");
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		<script src="../scripts/scripts.js"></script>
	</head>
	<body>
		<div width="500" height="50">
			<form method="post" action="upload_boletim.php" enctype="multipart/form-data" width="50">
			<fieldset >
				<legend align='center' >Adicionar Boletim do <font size="5" color="red">cepuerj</font></legend>
					<table border=1  align="center">
						<tr>
							<td align="center">
							
							<?php																
								echo("<label>Data:</label>");
								echo("<input type='date' id='data_busca' name='data_busca' value='$hoje' autofocus>");	
						    ?>	
								<label>Boletim:</label>
								<?php																
									echo("<input name='boletim' type='text' id='boletim' size='1' value='$proximo_boletim'>");
								?>
								
							</td>
						</tr>
						<tr>
							<td><input type="file" name="arquivos[]" multiple="multiple"></td>
						
						</tr>
						<tr>
							<td align="center"><input type="submit" class="btn btn-primary" value="Cadastrar Boletim"></td>
						</tr>
					</table>
					
				</fieldset>
			</form>
		</div>
		<hr>		
	<?php
		echo("<label ALIGN='center'></label>");
		
	?>
	<div width="500" height="50">
			<form method="post" action="confirma_exclusao.php" enctype="multipart/form-data" width="50">
			<fieldset >
				<legend align='center'>Excluir boletim do cepuerj</legend>
					<table border=1  align="center">
						<tr>
							<td align="center">
								<label style="color:red;">Favor preencher DATA ou BOLETIM</label>
							</td>
						</tr>
						<tr>						
							<td align="center">
							
							<?php																
								echo("<label>Data:</label>");
								echo("<input type='date' id='data_busca' name='data_busca' value='2000-01-01' autofocus>");	
						    ?>	
								<label>Boletim:</label>
								<?php	
									//$ultimo_boletim =  str_pad($ultimo_boletim, 3, '0', STR_PAD_LEFT);
									echo("<input name='boletim_excluir' type='text' id='boletim_excluir' size='1' value='000'>");
								?>
								
							</td>
						</tr>
						<tr>
							<td align="center"><input type="submit" class="btn btn-primary" value="Excluir"></td>
						</tr>
					</table>
					
				</fieldset>
			</form>
		</div>
</body>
</html>