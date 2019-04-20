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
	  <h2 id = "SERVICE">ONE PERSON. WHERE HAVE THEY BEEN. HAVE A LOOK.</h2>
	  <p id = INFORMATION>Where has this person been, working, not working, difficult to tell, this page only tells you where they've been. <br><br>
	  Go find them yourself if you want to know if they've been working.</p>
	</div>
	<br><br>
<div id = "SEARCH">
	  <form method = "get" action = "">
	    Search by User: <input type = "text" name = "searchstudent" placeholder = "123456"></input>
		<input type = "submit" value = "Search" name = "submit">
	  </form>
	</div>
    
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
		echo '<table id = "results">';
		echo '<tr><th>StudentID</th><th>DateTime</th><th>Location</th></tr>';
		while($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) 
		{
		echo '<tr>';
		echo '<td>' . $row['StudentID'] . '</td>'; 
		echo '<td>' . $row['DateTime']->format('d m Y H:i:s') . '</td>';
		echo '<td>' . $row['Location'] . '</td>';
	
		echo '</tr>';
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