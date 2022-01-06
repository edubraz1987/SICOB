<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	session_start();
	
	date_default_timezone_set('America/Sao_Paulo');
?>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
decisao = confirm("Clique CANCELAR para excluir boletins de outros anos e utilize a opção de data");
if (decisao = false){
   history.back();
}
</SCRIPT>
<?php	
	$con= mysql_connect("localhost","root","");
	$db= mysql_select_db("sicob");

	$boletim = isset($_POST['boletim_excluir'] ) ? $_POST['boletim_excluir']  : '000';	
	
	//$dt_boletim = "2000-01-01";
	$dt_boletim = isset($_POST['data_busca'] ) ? $_POST['data_busca'] : "2000-01-01";
	//echo("<script type='text/javascript'> alert('$dt_boletim');</script>");
	
	//$dt_boletim = $_POST['data_busca'];
	//$dt_boletim = isset($_POST['data_busca'] ) ? $_POST['data_busca'] : "2000-01-01";
	
	if($dt_boletim=="yyyy/mm/dd"){
		$dt_boletim="2000-01-01";
	}
	$dt_boletim = DateTime::createFromFormat('Y-m-d',$dt_boletim);
	
	//echo("<script type='text/javascript'> alert('$dt_boletim');</script>");
	
	$dt_bol = explode("-", $dt_boletim->format('Y-m-d'));
	$dia = $dt_bol[2];
	$mes = $dt_bol[1];
	$ano = $dt_bol[0];
	
	$year = date('Y');	
	
	//$boletim = intval($boletim);
	
	$tipo = $_SESSION['tipo'];
	if($ano="2000"){
		$ano = $year;
	}
	
	//echo("<script type='text/javascript'> alert('O número do boletim ou a data devem ser preenchidos!');history.back();</script>");
	
	$dt_selecionada = $dt_boletim->format('Y-m-d');

	if($tipo=="convenio"){
	//trocando o nome do campo da tabela por variável pra ter apenas uma página de delete
	//$id_tipo = "boletim";	//id que vai ser inserido 
	$tabela_filha = "arquivos_convenio";
	$id_boletim_pai = "id_bol_convenio";
	$id_arquivo = "id_arq_convenio";
	}
	elseif($tipo=="financeiro"){
		//$id_tipo = "boletim";	//id que vai ser inserido 
		$id_boletim_pai = "id_bol_financeiro";
		$tabela_filha = "arquivos_financeiro";
		$id_arquivo = "id_arq_financeiro";
	}
	elseif($tipo=="hupe"){
		//$id_tipo = "boletim";	//id que vai ser inserido 
		$id_boletim_pai = "id_bol_hupe";
		$tabela_filha = "arquivos_hupe";
		$id_arquivo = "id_arq_hupe";
	}
	else{
		echo("<script type='text/javascript'> alert('Tipo não permitido!');history.back();</script>");
	}	

	//TESTE DE PREENCHIMENTO
	if(($boletim=="000")&&($dt_selecionada=="2000-01-01")){
		echo("<script type='text/javascript'> alert('O número do boletim ou a data devem ser preenchidos!');location.href='$tipo.php';</script>");
	}
	elseif(($boletim<>"000")&&($dt_selecionada<>"2000-01-01")){
		echo("<script type='text/javascript'> alert('O número do boletim e a data não devem ser preenchidos juntos!');location.href='$tipo.php';</script>");
	}
	elseif(($boletim<>"000")&&($dt_selecionada=="2000-01-01")){ //deletar pelo número do boletim
		mysql_query("DELETE FROM $tabela_filha WHERE $id_boletim_pai = $boletim");
		//echo("<script type='text/javascript'> alert('DELETE FROM $tabela_filha WHERE $id_boletim_pai = $boletim');</script>");
		
		mysql_query("DELETE FROM $tipo WHERE boletim = $boletim");
		//echo("<script type='text/javascript'> alert('DELETE FROM $tipo WHERE boletim = $boletim');</script>");

		mysql_close($con);
		echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('Boletim $boletim excluído com sucesso!');location.href='$tipo.php';</script>";
	}
	elseif(($boletim=="000")&&($dt_selecionada<>"2000-01-01")){//deletar pela data do boletim
		mysql_query("DELETE FROM $tabela_filha USING $tipo INNER JOIN $tabela_filha WHERE $tabela_filha.$id_boletim_pai=$tipo.boletim AND $tipo.dt_boletim='$dt_selecionada'");
		mysql_close($con);
		echo "<SCRIPT LANGUAGE='JavaScript' TYPE='text/javascript'>alert('Boletim da data $dt_selecionada excluído com sucesso!');location.href='$tipo.php';</script>";
	}

	
	
	
		
		
		
	
		
		
	
	






?>