<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit | University of Hull</title>
	<link rel = "stylesheet" href = "StyleSheet.css" type = "text/css">
	<style>
	.error { color: #FF0000}
	</style>
</head>
<body>
   <header>
	  <img src = "" alt = "University of Hull">
	  <h3>Student Location Services</h3>
	</header>

	<nav>
	  <ul>
	    <li><a href = "index.php">Home</a></li>
		<li><a href = "findlocation.php">Locations</a></li>
		<li><a href = "adduser.php">Update User</a></li>
		<li><a href = "daylocation.php">24 Hours</a></li>
		<li><a href = "edituser.php">Edit User</a></li>
		<li><a href = "updatelocation.php">Add User</a></li>
	  </ul>
    </nav>

	<div id = "INTRO">
	  <h2 id = "SERVICE">EDIT USER. ADD USER. THE CHOICE. IT'S YOURS.</h2>
	  <p id = INFORMATION>This page will allow a user to create a new entry to the database for a persons information, as well as being able to edit a existing users information</p>
	</div>


	
	<div class = "row">
	  <div class = "column2">
	    <h2>Add new User</h2>
		<p><span class = "error">* required field</span></p>
		<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		StudentID: <input type = "text" name = "newid" value = "<?php echo $StudentNO; ?>" required>
		<span class = "error">* <?php echo $StudentIDErr;?></span>
		<br><br>
		Firstname: <input type = "text" name = "newfirst"  value = "<?php echo $editfirst; ?>"required>
		<span class = "error">* <?php echo $FirstnameErr;?></span>
		<br><br>
		Surname: <input type = "text" name = "newsurn" value = "<?php echo $editSurname; ?>" required>
		<span class = "error">* <?php echo $SurnameErr;?></span>
		<br><br>
		<input type = "submit" name = "AddNewUser" value = "Create User">
		</form>
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
	  </div>
	  <div class = "column2">
	  </div>
	  </div>
	  	<br>
	<footer>
	<div class = "row">
	  <div class = "column">
	    <h5 id = "COLHEAD">Current Students and Staff</h5>
		<p id = "PGOPT"><span>Schools and Faculties</span></p>
		<p id = "PGOPT"><span>Mail</span></p>
		<p id = "PGOPT"><span>Library</span></p>
		<p id = "PGOPT"><span>MyAdmin</span></p>
		<p id = "PGOPT" style="color:white;"><span>Canvas</span></p>
	  </div>
	  <div class = "column">
	    <h5 id = "COLHEAD">Contact</h5>
		<p id = "PGOPT"><span>+44 (0)1482 346311</span></p>
	  </div>
	  <div class = "column">
	    <h5 id = "COLHEAD">Find Us</h5>
		<p id = "ADDRESS"><span>University of Hull</span></p>
		<p id = "ADDRESS"><span>Hull, UK</span></p>
		<p id = "ADDRESS"><span>HU6 7RX</span></p>
		<br>
		<p id = "PGOPT"><span>Getting Here</span></p>
		<p id = "PGOPT"><span>Campus Map</span></p>
	  </div>
	</div>
	</footer>
</body>
</html>