<html>
	<title>UNIVERSIDADE DO ESTADO DO RIO DE JANEIRO</title>
	<head>
		<meta http-equiv="refresh" content="3" />
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<script src="scripts/scripts.js"></script>
		<script type='text/javascript'>
			function emObras(){
				alert('FUNCIONALIDADE EM DESENVOLVIMENTO!');
			}
			function servidor(){
				alert('ESTE SITE FOI DESCONTINUADO. VOCÊ SERÁ REDIRECIONADO!');
				window.location.href='http://dicre-servidor/';
			}
		</script>
		<?php
		session_start();		
		header('Content-Type: text/html; charset=utf-8');
		
		?>
	</head>	
	<body class="login" onload="servidor();">
		<div class="" id="containertopo" align="center">
			<div class="" id="titulo" align="center">
			</div>
		</div>		
	</body>

</html>