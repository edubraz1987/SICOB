<html>
	<head></head>
	<body>
<?php
	session_start();
	session_destroy();
	clearstatcache ();
	
	echo("<script type='text/javascript'>location.href='../index2.php';</script>");
?>
	</body>
</html>