<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Location | University of Hull</title>
	<link rel = "stylesheet" href = "StyleSheet.css" type = "text/css">
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
	  <h2 id = "SERVICE">LOCATIONS. DEGREES. PEOPLE. WHO WILL YOU FIND.</h2>
	  <p id = INFORMATION>Find yourself (in a data kind of way we're not here to discover our souls, those were lost long ago), find someone you love, someone you hate. 
	  <br><br>Or use this as a assasination service, its got locations, ID numbers, what more could a assasin need. (not celebrating murder here though)
	  <br><br>Find who you want to be, or not, this is a paragraph, i can't do anything to stop you at all really ¯\_(ツ)_/¯ </p>
	</div>
	<br><br>
	<div id = "SEARCH">
	  <form method = "get" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    Search by location: <input type = "text" name = "searchlocation" placeholder = "RBB-LTC" required></input>
		<input type = "submit" value = "Search" name = "submit">
	  </form>
	</div>
    
	<!-- This php stops a user entering bad input or no input -->
	<?php
		$validate = true;
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$validate = true;
				
				if(empty($_GET["searchlocation"])) {
					
					$validate = false;
				}
				else {
					$search_value = test_input($_GET["searchlocation"]);
					if (!preg_match("/^[A-Z-]*$/",$search_value)) {
				    
						$validate = false;
					}
					if(preg_match('/DROP/', $search_value) OR preg_match('/drop/', $search_value)) {
						
						echo '<script language="javascript">';
						echo 'alert("So we meet at last, you thought you could get away with this :D")';
						echo '</script>';
						$validate = false;
					}
				}		
		}
				

			if($validate = true) {

				$search_value=$_GET['searchlocation'];
				$server = 'sql.rde.hull.ac.uk';
				$connectionInfo = array("Database"=>"rde_556278");
				$conn = sqlsrv_connect($server, $connectionInfo);
				$search_value=$_GET['searchlocation'];
				$describeQuery="select Locations.StudentID, Locations.[DateTime] from Locations where Locations.Location = '$search_value' ";
				$results = sqlsrv_query($conn, $describeQuery);
				echo '<table id = "results">';
				echo '<tr><th>StudentID</th><th>DateTime</th></tr>';
				while($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) 
				{
				echo '<tr>';
				echo '<td>' . $row['StudentID'] . '</td>'; 
				echo '<td>' . $row['DateTime']->format('d m Y H:i:s') . '</td>';
	
				echo '</tr>';
				} 
				echo '</table>';
				sqlsrv_free_stmt( $describeQuery);
				sqlsrv_close($conn);
			}
			function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			  
			return $data;
		}
	?>
	
	<!-- THE FOOTER -->
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