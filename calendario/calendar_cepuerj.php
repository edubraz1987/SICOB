<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<?php
	session_start();
	
	header('Content-Type: text/html; charset=ISO-8859-1');
	
	$con= mysqli_connect("localhost","root","","sicob");
	////$db= mysqli_select_db("sicob");

	mysqli_query($con,"SET NAMES 'utf8'");
	mysqli_query($con,'SET character_set_connection=utf8');
	mysqli_query($con,'SET character_set_client=utf8');
	mysqli_query($con,'SET character_set_results=utf8');
	
	$month=date('n');
	//$year=date('Y');
	$day=date('d');
	$months=array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
	
	$_SESSION['tipo'] = "cepuerj";
	$_SESSION['sistema']  = "bol";
	
	$year = isset($_GET['ano']) ? $_GET['ano'] : 2020;
	?>
	<div class="rodape2">
		<table align="center">
		<tr>
			<th><a class="linksmenuativo" href="calendar_cepuerj.php?ano=2020" >2020</a></th>
			<th>|</th>
			<th><a class="linksmenuativo" href="calendar_cepuerj.php?ano=2019" >2019</a></th>
		</tr>
		</table>
	</div>
	<?php
	echo '<fieldset><legend align=center style="font-family:Verdana; font-size:20pt; color:#005588;">'.$year.'</legend>';
	echo '<table border=0 width=100%>';
	//echo '<th colspan=4 align=center style="font-family:Verdana; font-size:18pt; color:#005588;">'.$year.'</th>';
		for ($reihe=1; $reihe<=3; $reihe++) {
			echo '<tr>';
			for ($spalte=1; $spalte<=4; $spalte++) {
				$this_month=($reihe-1)*4+$spalte; 
				$erster=date('w',mktime(0,0,0,$this_month,2,$year)); //Representaçao numérica do dia da semana
				$insgesamt=date('t',mktime(0,0,0,$this_month,1,$year)); //numero de dias no mes
				if ($erster==0) $erster=7;
					echo '<td width="25%" valign=top>';
				echo '<table border=0 align=center style="font-size:8pt; font-family:Verdana">';
				echo '<th colspan=7 align=center style="font-size:12pt; font-family:Arial; color:#666699;">'.$months[$this_month-1].'</th>';
				echo '<tr style="font-size:14 pt">';
				echo '<td align=center style="color:#666666"><b>D</b></td>';
				echo '<td align=center style="color:#666666"><b>S</b></td>';
				echo '<td align=center style="color:#666666"><b>T</b></td>';
				echo '<td align=center style="color:#666666"><b>Q</b></td>';
				echo '<td align=center style="color:#666666"><b>Q</b></td>';
				echo '<td align=center style="color:#666666"><b>S</b></td>';
				echo '<td align=center style="color:#666666"><b>S</b></td>';
				echo '</tr><tr><br>';
				$i=1;
			
				while ($i<$erster) {
					echo '<td> </td>';
					$i++;
				}
				$i=1;
				while ($i<=$insgesamt) {
					$rest=($i+$erster-1)%7;
					if (($i==$day) && ($this_month==$month)) { //INSERIR O LINK DO BOLETIM AQUI
						echo '<td style="font-size:11pt; font-family:Verdana;" align=center>';
						//echo '<td style="font-size:8pt; font-family:Verdana; background:#0000ff;" align=center>';
					} 
					else {
						echo '<td style="font-size:11pt; font-family:Verdana" align=center>';
					}

					if (($i==$day) && ($this_month==$month)) { //---> hoje
						echo '<span style="color:#000000; ">'.$i.'</span>';
					}
					else if ($rest==0) {  //---> sabado
						echo '<span style="color:#bbb; ">'.$i.'</span>';
					} 
					else if ($rest==1) {  //---> domingo
						$dt_boletim = $year."-".$this_month."-".$i;
						
						$sql_cepuerj = "select id_cepuerj, ano, boletim, dt_boletim from cepuerj where ano='$year' and dt_boletim='$dt_boletim'";
						$rs_cepuerj = mysqli_query($con,$sql_cepuerj) or die(mysql_error());
						
						//echo $sql_cepuerj;						
						
						if(mysqli_num_rows($rs_cepuerj)<>0){
							while ($linha_cepuerj=mysqli_fetch_array($rs_cepuerj)) {
															
								$id_cepuerj=$linha_cepuerj['id_cepuerj'];
								$ano=$linha_cepuerj['ano'];
								$boletim=$linha_cepuerj['boletim'];
								$dt_boletim=$linha_cepuerj['dt_boletim'];
								
								$date = new DateTime($dt_boletim);
								//echo $date->format('dd-mm-Y');
								
								$dt_bol = explode("-", $date->format('d-m-Y'));
								$dia = $dt_bol[0]*1;
								$mes = $dt_bol[1]*1;
								//echo $dia;
								//echo $mes;
									
								//echo $dia .'/'. $mes;
								
								switch ($mes){
									case "01":    $mes = "Janeiro";     break;
									case "02":    $mes = "Fevereiro";   break;
									case "03":    $mes = "Março";       break;
									case "04":    $mes = "Abril";       break;
									case "05":    $mes = "Maio";        break;
									case "06":    $mes = "Junho";       break;
									case "07":    $mes = "Julho";       break;
									case "08":    $mes = "Agosto";      break;
									case "09":    $mes = "Setembro";    break;
									case "10":    $mes = "Outubro";     break;
									case "11":    $mes = "Novembro";    break;
									case "12":    $mes = "Dezembro";    break; 
								 }		
								//echo $dia .'/'. $mes;
								//echo $day .'/'.$months[0];
															
								$zeros_boletim = str_pad($boletim, 3, '0', STR_PAD_LEFT);
								
								echo '<span style="color:#000;"><a class="linque" title="BOLETIM '.$zeros_boletim.'" target="_blank" href="exibe_boletim.php?boletim='.$boletim.'&data='.$dia.'-'.$mes.'-'.$ano.'">'.$i.'<a></span>'; //aqui entra o IF do boletim com o link do banco	
							}
						}
						else{
							echo '<span style="color:#bbb">'.$i.'</span>';
						}
					} 
					else { //-------> dias da semana
					
						$dt_boletim = $year."-".$this_month."-".$i;
						
						$sql_cepuerj = "select id_cepuerj, ano, boletim, dt_boletim from cepuerj where ano='$year' and dt_boletim='$dt_boletim'";
						$rs_cepuerj = mysqli_query($con,$sql_cepuerj) or die(mysql_error());
						
						//echo $sql_cepuerj;						
						
						if(mysqli_num_rows($rs_cepuerj)<>0){
							while ($linha_cepuerj=mysqli_fetch_array($rs_cepuerj)) {
															
								$id_cepuerj=$linha_cepuerj['id_cepuerj'];
								$ano=$linha_cepuerj['ano'];
								$boletim=$linha_cepuerj['boletim'];
								$dt_boletim=$linha_cepuerj['dt_boletim'];
								
								$date = new DateTime($dt_boletim);
								//echo $date->format('dd-mm-Y');
								
								$dt_bol = explode("-", $date->format('d-m-Y'));
								$dia = $dt_bol[0]*1;
								$mes = $dt_bol[1]*1;
								//echo $dia;
								//echo $mes;
									
								//echo $dia .'/'. $mes;
								
								switch ($mes){
									case "01":    $mes = "Janeiro";     break;
									case "02":    $mes = "Fevereiro";   break;
									case "03":    $mes = "Março";       break;
									case "04":    $mes = "Abril";       break;
									case "05":    $mes = "Maio";        break;
									case "06":    $mes = "Junho";       break;
									case "07":    $mes = "Julho";       break;
									case "08":    $mes = "Agosto";      break;
									case "09":    $mes = "Setembro";    break;
									case "10":    $mes = "Outubro";     break;
									case "11":    $mes = "Novembro";    break;
									case "12":    $mes = "Dezembro";    break; 
								 }		
								//echo $dia .'/'. $mes;
								//echo $day .'/'.$months[0];
								$zeros_boletim = str_pad($boletim, 3, '0', STR_PAD_LEFT);						
								
								echo '<span style="color:#000;"><a class="linque" title="BOLETIM '.$zeros_boletim.'" target="_blank" href="exibe_boletim.php?boletim='.$boletim.'&data='.$dia.'-'.$mes.'-'.$ano.'">'.$i.'<a></span>'; //aqui entra o IF do boletim com o link do banco	
							}
						}
						else{
							echo '<span style="color:#000;">'.$i.'<a></span>';
						}
						//echo $i;
					}
					echo "</td>\n";
						if ($rest==0) echo "</tr>\n<tr>\n";
							$i++;
						}
				echo '</tr>';
				echo '</table>';
				echo '</td>';
			}
	echo '</tr>';
	}
	echo '</table></fieldset>';
?>