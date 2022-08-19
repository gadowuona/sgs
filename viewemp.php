<?php

require_once ('process/dbh.php');
$sql = "SELECT * from `employee`";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>View Employee |  Admin Panel | SGS Supervisors Management System</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<header>
		<nav>
			<h1>EMS</h1>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Supervisor</a></li>
				<li><a class="homered" href="viewemp.php">View Supervisor</a></li>
				<li><a class="homeblack" href="assign.php">Assign Thesis</a></li>
				<li><a class="homeblack" href="assignproject.php">Thesis Status</a></li>
				
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>

		<table>
			<tr>

				<th align = "center">Staff ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<!--<th align = "center">Birthday</th>
				<th align = "center">Gender</th>  -->
				<th align = "center">Contact</th>
				<th align = "center">NID</th>
				<th align = "center">Address</th>
				<th align = "center">College</th>
				<th align = "center">Faculty/School</th>
				<th align = "center">Department</th>
				<th align = "center">Qualification</th>
				
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['staffid']."</td>";
					echo "<td><img src='process/images/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['email']."</td>";
					//echo "<td>".$employee['birthday']."</td>";
					//echo "<td>".$employee['gender']."</td>";
					echo "<td>".$employee['contact']."</td>";
					echo "<td>".$employee['nid']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td>".$employee['college']."</td>";
					echo "<td>".$employee['faculty']."</td>";
					echo "<td>".$employee['school']."</td>";
					echo "<td>".$employee['dept']."</td>";
					echo "<td>".$employee['qual']."</td>";
					

					echo "<td><a href=\"edit.php?id=$employee[id]\">Edit</a> | <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>