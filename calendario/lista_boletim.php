<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<script src="../scripts/scripts.js"></script>
</head>
<script language="JavaScript">
	function fechar(){
		window.opener = window;
	window.close("#");
	}
</script>
<?php
	session_start();
	
	header('Content-Type: text/html; charset=utf-8');
	
	
	$con= mysqli_connect("localhost","root","","sicob");
	//$db= mysqli_select_db("sicob");
	
	mysqli_query($con,"SET NAMES 'utf8'");
	mysqli_query($con,'SET character_set_connection=utf8');
	mysqli_query($con,'SET character_set_client=utf8');
	mysqli_query($con,'SET character_set_results=utf8');
	
	
	$boletim = isset($_GET['boletim']) ? $_GET['boletim'] : '';
	$data = isset($_GET["data"]) ? $_GET["data"] : '';
	
	$tipo = $_SESSION['tipo'];
	
	//echo $tipo;
	
	if($tipo=="convenio"){
		//trocando o nome do campo da tabela por variável pra ter apenas uma página de upload
		$id_tipo = "id_convenio";	//id que vai ser inserido 
		$tabela_filha = "arquivos_convenio";
		$id_boletim_pai = "id_bol_convenio";
		$id_arquivo = "id_arq_convenio";
	}
	elseif($tipo=="financeiro"){
		$id_tipo = "id_financeiro";	//id que vai ser inserido 
		$id_boletim_pai = "id_bol_financeiro";
		$tabela_filha = "arquivos_financeiro";
		$id_arquivo = "id_arq_financeiro";
	}
	elseif($tipo=="hupe"){
		$id_tipo = "id_hupe";	//id que vai ser inserido 
		$id_boletim_pai = "id_bol_hupe";
		$tabela_filha = "arquivos_hupe";
		$id_arquivo = "id_arq_hupe";
	}
	elseif($tipo=="cepuerj"){
		$id_tipo = "id_cepuerj";	//id que vai ser inserido 
		$id_boletim_pai = "id_bol_cepuerj";
		$tabela_filha = "arquivos_cepuerj";
		$id_arquivo = "id_arq_cepuerj";
	}
	else{
		echo("<script type='text/javascript'> alert('Tipo não permitido!');history.back();</script>");
	}	
	
	//echo $data."data";
	$dt_bol = explode("-", $data);
	
	//echo $dt_bol[2];
	$year = $dt_bol[2];
	
	$sql_tipo = "select $id_tipo, ano, boletim, dt_boletim from $tipo where ano='$year' and boletim = '$boletim'";
	$rs_tipo = mysqli_query($con,$sql_tipo) or die(mysql_error());
	
	echo "<body>";
	echo "	<div class='login3' align='center' valign='left' >";
	
	echo "	<table border='1'  class=''>";
	
	while ($linha_tipo=mysqli_fetch_array($rs_tipo)) {
		if($tipo=="convenio"){		
			$id_convenio=$linha_tipo['id_convenio'];
		}
		elseif($tipo=="financeiro"){
			$id_financeiro=$linha_tipo['id_financeiro'];
		}
		elseif($tipo=="hupe"){
			$id_hupe=$linha_tipo['id_hupe'];
		}
		$ano=$linha_tipo['ano'];
		$boletim=$linha_tipo['boletim'];
		$dt_boletim=$linha_tipo['dt_boletim'];
		
		$date = new DateTime($dt_boletim);
		$dt_bol = explode("-", $date->format('d-m-Y'));
		
		$zeros_boletim = str_pad($boletim, 3, '0', STR_PAD_LEFT);
	
	echo "				<tr>";
	echo "					<td width='200' align='center'><b>Boletim ".$zeros_boletim." - ".$dt_bol[0]."/".$dt_bol[1]."/".$year."</td>";
	echo "				</tr>";
	
	}
	
	$sql_lista = "SELECT `$id_arquivo`,`$id_boletim_pai`,`arquivo` FROM `$tabela_filha`,`$tipo` WHERE `$id_boletim_pai` = `boletim` and `$id_boletim_pai`=$boletim order by tipo asc";
	$rs_lista = mysqli_query($con,$sql_lista) or die(mysql_error());
	
	$cont = 1;
	
	while ($linha_lista=mysqli_fetch_array($rs_lista)) {	
		if($tipo=="convenio"){
			$id_arq_convenio=$linha_lista['id_arq_convenio'];
			$id_bol_convenio=$linha_lista['id_bol_convenio'];
		}
		elseif($tipo=="financeiro"){
			$id_arq_financeiro=$linha_lista['id_arq_financeiro'];
			$id_bol_financeiro=$linha_lista['id_bol_financeiro'];
		}
		elseif($tipo=="hupe"){
			$id_arq_hupe=$linha_lista['id_arq_hupe'];
			$id_bol_hupe=$linha_lista['id_bol_hupe'];
		}
		$arquivo=$linha_lista['arquivo'];
		
		$nome_arquivo = explode("-",$arquivo);
		$sigla = $nome_arquivo[4];
		
		switch ($sigla){
			case "cc":    $sigla = "Conta Corrente";     break;
			case "fix":    $sigla = "Conta Investimento";   break;
			case "poup":    $sigla = "Conta Poupança";       break;
			case "rec":    $sigla = "Classificação de Receitas";   break;
			case "des":    $sigla = "Classificação de Despesas";   break;
			case "nf":    $sigla = "NOTA FISCAL";       break;
			case "nf1":    $sigla = "NOTA FISCAL";       break;
			case "nf2":    $sigla = "NOTA FISCAL";       break;
			case "nf3":    $sigla = "NOTA FISCAL";       break;
			case "nf4":    $sigla = "NOTA FISCAL";       break;
			case "nf5":    $sigla = "NOTA FISCAL";       break;
			case "nf6":    $sigla = "NOTA FISCAL";       break;
			case "nf7":    $sigla = "NOTA FISCAL";       break;
			case "ci":    $sigla = "CIRCULAR INTERNA";       break;
			case "of":    $sigla = "OFÍCIO";      break;
			case "mm":    $sigla = "MEMORANDO";    break;
			case "ext":    $sigla = "EXTRATO";     break;
			case "out":    $sigla = "OUTROS";    break;
			case "hupe":    $sigla = "BOLETIM - HUPE";    break;
			case "base":    $sigla = "BASE CONTRATUAL";    break;
			case "basedev":    $sigla = "DEVOLUÇÕES - BASE CONTRATUAL";    break;
			case "depati":    $sigla = "RELATÓRIO DE BOLETOS DEPATI";    break;
			case "cau":    $sigla = "PLANILHA DE CAUÇÃO";    break;
		 }
		
		$link = "../arquivos/$tipo/$year/$arquivo.pdf";
		
		echo "	<tr>";
		echo "		<td align='center' id='arquivo'><a href='$link' TARGET='coluna2'>$sigla</a></td>";
		if ($cont==1){
			echo "<script type='text/JavaScript'>window.open('$link',target='coluna2');</script>";
		}
		echo "	</tr>";
		
		$cont++;
	}
	//if registro nesse dia - nova base de dados
	/*
	echo "<tr><td width='200' align='center'><hr></td><tr>";
	echo "<tr><td align='center'><a href='';' >BOLETO IMÓVEIS</A></td></tr>";*/
	echo "			</table>";
	
	
	echo "	</form>";
	echo "	</body>";
?>
</html>
	
	
