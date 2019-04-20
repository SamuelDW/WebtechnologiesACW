<html>
  <head>
    <title>Student Location Service | University of Hull</title>
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
	  <h2 id = "SERVICE">ONE SERVICE. ONE LOCATION. YOURS FOR THE TAKING.</h2>
	  <p id = INFORMATION>This ACW is all about using PHP, SQL and various associated languages to create a site where it is possible to locate a user, in a variety of different ways, as well as view their past locations
	  <br><br>Feel free to use the site and attempt to break it, all feedback is welcome. And for the love of god, no: Sucker');DROP TABLE Students;-- </p>
	</div>
	
	<!-- The code below Connects to the database, and returns all users most recent location -->
	<?php 
	$server = 'sql.rde.hull.ac.uk';
	$connectionInfo = array("Database"=>"rde_556278");
	$conn = sqlsrv_connect($server, $connectionInfo);

	$describeQuery='select Users.Firstname, Users.Surname, Users.StudentID, Locations.Location, Locations.[DateTime] from Users, Locations where Users.StudentID = Locations.StudentID ORDER BY  DateTime desc';
	$results = sqlsrv_query($conn, $describeQuery);

	$validate = "";

	echo '<table id = "results">';
	echo '<tr><th>Firstname</th><th>Surname</th><th>StudentID</th><th>Location</th><th>DateTime</th></tr>';
	while($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) 
	{
		if($validate != row['Locations.StudentID']) {
			

			echo '<tr>';
			echo '<td>' . $row['Firstname'] . '</td>'; 
			echo '<td>' . $row['Surname'] . '</td>'; 
			echo '<td>' . $row['StudentID'] . '</td>'; 
			echo '<td>' . $row['Location'] . '</td>';
			echo '<td>' . $row['DateTime']->format('d m Y H:i:s') . '</td>';
	
			echo '</tr>';
			$validate = $row['Locations.StudentID'];
		}
	} 
	echo '</table>';
	sqlsrv_free_stmt( $describeQuery);
	sqlsrv_close($conn);
	?>


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