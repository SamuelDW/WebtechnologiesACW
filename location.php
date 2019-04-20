<?php
	    $search_value=$_GET['searchstudent'];
	    $server = 'sql.rde.hull.ac.uk';
		$connectionInfo = array("Database"=>"rde_556278");
		$conn = sqlsrv_connect($server, $connectionInfo);
		$search_value=$_GET['searchstudent'];
		$describeQuery="SELECT * FROM Locations WHERE StudentID = '$search_value' order by DateTime desc";
		$results = sqlsrv_query($conn, $describeQuery);
		$resultCount = sqlsrv_has_rows($results);
		if($resultCount == false){
			$insertQuery = "INSERT INTO Users (StudentID) VALUES ('$search_value');";
			sqlsrv_query($conn, $insertQuery);
		}
		
		while($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) 
		{
			if($row['StudentID'] == $search_value)	{
				$xmlthingy =  $row['Location'];
			} 
		}
		header('Content-Type:application/json');
		echo json_encode($xmlthingy);

		sqlsrv_free_stmt( $describeQuery);
		sqlsrv_close($conn);	
	?>

	<?php
			$ErrorCount = 0;
			$StudentNO = $_POST['newid'];
			$editfirst = $_POST['newfirst'];
			$editSurname = $_POST['newsurn'];

			if(strlen($_POST['newid']) != 6) {
				$ErrorCount++;
			}


			$editfirst = test_input($editfirst);
			$editSurname = test_input($editSurname);
			$StudentNO = test_input2($StudentNO);
			function test_input($data) {
				$data = trim($data);
				$data = preg_replace("/[^a-zA-Z-]/", "", $data);
				if($data == "") {
					$ErrorCount++;
				}
				return $data;
			}
			function test_input2($data) {
				$data = trim($data);
				$data = preg_replace("/[^a-zA-Z0-9]/", "", $data);
				if($data == "") {
					$ErrorCount++;
				}
				return $data;
			}

			if($ErrorCount == 0) {
				$server = 'sql.rde.hull.ac.uk';
				$connectionInfo = array("Database"=>"rde_556278");
				$conn = sqlsrv_connect($server, $connectionInfo);

				$updateQuery = "INSERT INTO Users (StudentID, Firstname, Surname) VALUES (?, ?, ?);";
				$params = array($StudentNO, $editfirst, $editSurname);
				$result = sqlsrv_query($conn, $updateQuery, $params);

				sqlsrv_free_stmt($updateQuery);
				sqlsrv_close($conn);
			}
		?>