<html>
<head>
<title>UERJ</title>
<style>
	frameset {
		border: 1px;
		border-style: dashed;
		border-color: grey;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		border-bottom-left-radius: 5px;
		border-bottom-right-radius: 5px;
	}
	frame {
		border: 1px;
		border-style: solid;
		border-color: grey;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		border-bottom-left-radius: 5px;
		border-bottom-right-radius: 5px;
	}
</style>
<script></script>

<?php
session_start();


$boletim = isset($_GET['boletim']) ? $_GET['boletim'] : '';
$data = isset($_GET['data']) ? $_GET['data'] : '';

$tipo = $_SESSION['tipo'];

?>
</head>
<?php

	echo '<FRAMESET ROWS="78x,100%" border="1" id="frame">';
	echo '	<FRAME SRC="cabecalho.php" scrolling="no" align="middle" id="linha1" name="linha1">';
	echo '	<frameset COLS="250PX,*">';
	echo '		<FRAME SRC="lista_boletim.php?boletim='.$boletim.'&data='.$data.'" id="coluna1" name="coluna1" onload="">';
	echo '		<FRAME SRC="" id="coluna2" name="coluna2">';
	echo '	</frameset>';
	echo '<noframes>';
	echo '	<body>';
	echo '	</body>';
	echo '</noframes>';
	echo '</FRAMESET>';

?>
</html>
