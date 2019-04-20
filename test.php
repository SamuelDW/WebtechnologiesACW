<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>

 <?php
		$servername = "sql.rde.hull.ac.uk";
		$ConnectionOptions = array("Database"=>"rde_556278");
		$Conn = sqlsrv_connect($servername, $ConnectionOptions);
		if($Conn === false )
		{
		  echo "<br \><p align=\"center\">Connection failed.<br />";
		  die( print_r( sqlsrv_errors(), true));
		}
		else
		{
		  echo "<br \><p align=\"center\">Connection to your SQL Database succeeded.</p><br />";
		}
		phpinfo();
	?>

</body>
</html>