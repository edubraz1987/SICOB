<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
	session_start();
	
	date_default_timezone_set('America/Sao_Paulo');
	
	$tipo = $_SESSION['tipo'];
	
	$con= mysql_connect("localhost","root","");
	$db= mysql_select_db("sicob");
	
	$dt_boletim = isset($_POST['data_busca'] ) ? $_POST['data_busca']  : '2000-01-01';
	$boletim = isset($_POST['boletim'] ) ? $_POST['boletim']  : '';
	
	$arqEmpty = $_FILES['arquivos']['name'][0];
	$ano = '2019';
	
	/*echo("<script type='text/javascript'> alert('".$_FILES.length."');</script>");
	echo("<script type='text/javascript'> alert('".print($_FILES['arquivos'][1])."');</script>");
	echo("<script type='text/javascript'> alert('".print($_FILES['arquivos'][2])."');</script>");
	echo("<script type='text/javascript'> alert('".print($_FILES['arquivos'][3])."');</script>");
	echo("<script type='text/javascript'> alert('".print($_FILES['arquivos'][4])."');</script>");*/
	
	$sql_data = "select boletim,dt_boletim from $tipo where ano='$ano' and dt_boletim='$dt_boletim'";
	$rs_data = mysql_query($sql_data);
	
	//echo $sql_pesquisa;
	$boletim_bd=0;
	$dt_boletim_bd="";
	
	while ($linha_data=mysql_fetch_array($rs_data)) {
		$boletim_bd=$linha_data['boletim'];
		$dt_boletim_bd=$linha_data['dt_boletim'];
	}
		
	if(empty($arqEmpty)||($boletim=='')){
		echo("<script type='text/javascript'> alert('Por favor, selecione os arquivos e preencha todos os campos!');history.back();</script>");
	}
	elseif(($boletim_bd<>$boletim)&&($dt_boletim_bd==$dt_boletim)){		
		//echo("<script type='text/javascript'> alert('$boletim | $boletim_bd');</script>");
		//echo("<script type='text/javascript'> alert('$dt_boletim | $dt_boletim_bd');</script>");
		echo("<script type='text/javascript'> alert('Essa data já possui boletim cadastrado. Favor verificar os dados!');history.back();</script>");	
	}
	else{
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
			
		$arquivo = isset($_FILES['arquivos']) ? $_FILES['arquivos'] : FALSE;
		$arqTemp = $_FILES['arquivos']['tmp_name'];
		
		//$dt_boletim = $_POST['data_busca'];
		$dt_boletim2 = new DateTime($dt_boletim);
			
		$dt_bol = explode("-", $dt_boletim2->format('d-m-Y'));
		$dia = $dt_bol[0];
		$mes = $dt_bol[1];
		$ano = $dt_bol[2];
		
		//$boletim = $_POST['boletim'];
		//$boletim = intval($boletim);
		
		$year = date('Y');
		
		$pasta_tipo = "../arquivos/$tipo";
		$pasta_ano = "../arquivos/$tipo/$year";
		
		$dt_selecionada = $dt_boletim2->format('Y-m-d');			

		//CRIAR A PASTA CASO NÃO EXISTA
		if(!is_dir($pasta_tipo)){
			mkdir("../arquivos/$tipo",0777);
		}
		elseif(!is_dir($pasta_ano)){
			mkdir("../arquivos/$tipo/$year",0777);
		}
		
		$diretorio = $pasta_ano;		
		
		//SQL para verificar a existência do boletim;
		//$sql_pesquisa = "select boletim from $tipo where ano='$ano' and boletim='$boletim' and dt_boletim='$dt_selecionada'";
		$sql_pesquisa = "select boletim,dt_boletim from $tipo where ano='$ano' and boletim='$boletim'";
		$rs_pesquisa = mysql_query($sql_pesquisa);
		
		//echo $sql_pesquisa;
		$boletim_bd=0;
		$dt_boletim_bd="";
		
		while ($linha_pesquisa=mysql_fetch_array($rs_pesquisa)) {
			$boletim_bd=$linha_pesquisa['boletim'];
			$dt_boletim_bd=$linha_pesquisa['dt_boletim'];
		}
		
		//$dt_boletim_bd = $dt_boletim_bd->format('Y-m-d');
		if(($boletim_bd==$boletim)&&($dt_boletim_bd<>$dt_boletim)){
			//echo("<script type='text/javascript'> alert('$boletim | $boletim_bd');</script>");
			//echo("<script type='text/javascript'> alert('$dt_boletim | $dt_boletim_bd');</script>");
			echo("<script type='text/javascript'> alert('Boletim já cadastrado em outra data. Favor verificar os dados!');history.back();</script>");		
		}		
		elseif(($boletim_bd==$boletim)&&($dt_boletim_bd==$dt_boletim)){ // boletim cadastrado e teste de data
			echo("<script type='text/javascript'> alert('Boletim já cadastrado nesta data. Será substituído!');</script>");
			
			$sql_substituicao="DELETE FROM $tabela_filha USING $tipo INNER JOIN $tabela_filha WHERE $tabela_filha.$id_boletim_pai=$tipo.boletim AND $tabela_filha.$id_boletim_pai=$boletim AND $tipo.ano='$ano'";
			mysql_query($sql_substituicao) or die (mysql_error());
			
			for ($k = 0; $k < count($arquivo['name']); $k++)
			{
				$nome_arquivo=explode("-",$arquivo['name'][$k]);
				$remove_extensao=explode(".",$nome_arquivo[4]);
				$sigla=$remove_extensao[0];
				
				switch ($sigla){
					case "cc":    $tp_lista = 1;     break;
					case "hupe":    $tp_lista = 1;   break;
					case "fix":    $tp_lista = 2;   break;
					case "base":    $tp_lista = 2;   break;
					case "basedev":    $tp_lista = 3;   break;
					case "poup":    $tp_lista = 3;       break;
					case "rec":    $tp_lista = 4;   break;
					case "des":    $tp_lista = 5;   break;
					case "nf":    $tp_lista = 6;       break;
					case "nf1":    $tp_lista = 6;       break;
					case "nf2":    $tp_lista = 6;       break;
					case "nf3":    $tp_lista = 6;       break;
					case "nf4":    $tp_lista = 6;       break;
					case "nf5":    $tp_lista = 6;       break;
					case "nf6":    $tp_lista = 6;       break;
					case "nf7":    $tp_lista = 6;       break;
					case "nf8":    $tp_lista = 6;       break;
					case "nf9":    $tp_lista = 6;       break;
					case "ci":    $tp_lista = 7;       break;
					case "of":    $tp_lista = 8;      break;
					case "mm":    $tp_lista = 9;    break;
					case "ext":    $tp_lista = 9;     break;
					case "out":    $tp_lista = 9;    break;
				}
							
				$nome_final = $boletim."-".$dia."-".$mes."-".$ano."-".$sigla;
				$destino = $diretorio."/".$nome_final.".pdf";
				
				$data_hora = date('YmdHi');
				
				$historico = $pasta_ano."/historico";
				$arq_historico = $historico."/".$nome_final."-".$data_hora.".pdf";	
				
				/*$sql_arquivos = "INSERT INTO $tabela_filha($id_arquivo, $id_boletim_pai, arquivo) VALUES (NULL,'$boletim','$nome_final')";
				mysql_query($sql_arquivos) or die (mysql_error());*/
				
				if (file_exists($destino)) {
					//instruções de gravação no banco caso arquivo exista serão ignoradas
					if(!is_dir($historico)){ 
						mkdir($historico,0777);
					}
					$upload2 = copy($destino, $arq_historico);
					//O arquivo destino existe
				}
				
				//instruções de gravação no banco caso arquivo não exista
				//vai gravar na tabela filha o registro do arquivo
				
				$sql_arquivos = "INSERT INTO $tabela_filha($id_arquivo, $id_boletim_pai, arquivo, tipo) VALUES (NULL,'$boletim','$nome_final','$tp_lista')";
				mysql_query($sql_arquivos) or die (mysql_error());
				
				$upload = move_uploaded_file($arqTemp[$k], $destino);	
				
				if($k==count($arquivo['name'])-1){
					echo("<script type='text/javascript'> alert('Boletim $boletim substituído com sucesso!');location.href='$tipo.php';</script>");
				}		
			}
		}
		elseif(mysql_affected_rows()==0){ //boletim não cadastrado
			//instruções de gravação no banco pq o boletim não existe
				for ($k = 0; $k < count($arquivo['name']); $k++){
						
					$nome_arquivo=explode("-",$arquivo['name'][$k]);
					$remove_extensao=explode(".",$nome_arquivo[4]);
					
					/*echo("<script type='text/javascript'> alert('".$nome_arquivo[0]."');</script>");
					echo("<script type='text/javascript'> alert('".$nome_arquivo[1]."');</script>");
					echo("<script type='text/javascript'> alert('".$nome_arquivo[2]."');</script>");
					echo("<script type='text/javascript'> alert('".$nome_arquivo[3]."');</script>");*/
					
					$sigla=$remove_extensao[0];
								
					$nome_final = $boletim."-".$dia."-".$mes."-".$ano."-".$sigla;
					$destino = $diretorio."/".$nome_final.".pdf";
					
					$tp_lista = 0;
					
					switch ($sigla){
						case "cc":    $tp_lista = 1;     break;
						case "hupe":    $tp_lista = 1;   break;
						case "fix":    $tp_lista = 2;   break;
						case "base":    $tp_lista = 2;   break;
						case "basedev":    $tp_lista = 3;   break;
						case "poup":    $tp_lista = 3;       break;
						case "rec":    $tp_lista = 4;   break;
						case "des":    $tp_lista = 5;   break;
						case "nf":    $tp_lista = 6;       break;
						case "nf1":    $tp_lista = 6;       break;
						case "nf2":    $tp_lista = 6;       break;
						case "nf3":    $tp_lista = 6;       break;
						case "nf4":    $tp_lista = 6;       break;
						case "nf5":    $tp_lista = 6;       break;
						case "nf6":    $tp_lista = 6;       break;
						case "nf7":    $tp_lista = 6;       break;
						case "nf8":    $tp_lista = 6;       break;
						case "nf9":    $tp_lista = 6;       break;
						case "ci":    $tp_lista = 7;       break;
						case "of":    $tp_lista = 8;      break;
						case "mm":    $tp_lista = 9;    break;
						case "ext":    $tp_lista = 9;     break;
						case "out":    $tp_lista = 9;    break;
					}
							
					$data_hora = date('YmdHi');
					
					$historico = $pasta_ano."/historico";
					$arq_historico = $historico."/".$nome_final."-".$data_hora.".pdf";
					
					if (file_exists($destino)) {
						//instruções de gravação no banco caso arquivo exista serão ignoradas
						if(!is_dir($historico)){ 
							mkdir($historico,0777);
						}
						$upload2 = copy($destino, $arq_historico);
						//O arquivo destino existe
					}
					$upload = move_uploaded_file($arqTemp[$k], $destino);
					
					if($k==0){
						$sql_boletim = "INSERT INTO $tipo($id_tipo, ano, boletim, dt_boletim) VALUES (NULL,'$ano','$boletim','$dt_selecionada')";
						mysql_query($sql_boletim) or die (mysql_error());
					}
					
					$sql_arquivos = "INSERT INTO $tabela_filha($id_arquivo, $id_boletim_pai, arquivo, tipo) VALUES (NULL,'$boletim','$nome_final','$tp_lista')";
					mysql_query($sql_arquivos) or die (mysql_error());
					
					$upload = move_uploaded_file($arqTemp[$k], $destino);
					
					if($k==count($arquivo['name'])-1){
						echo("<script type='text/javascript'> alert('Cadastrado com sucesso!');location.href='$tipo.php';</script>");
					}
					
				}
		}
	}
	
	
	
		
		
		
	
		
		
	
	






?>