<?php

require_once ('process/dbh.php');
$sql = "SELECT * FROM `employee` WHERE 1";

//echo "$sql";
$result = mysqli_query($conn, $sql);
if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$staffid = mysqli_real_escape_string($conn, $_POST['staffid']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
	$contact = mysqli_real_escape_string($conn, $_POST['contact']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$nid = mysqli_real_escape_string($conn, $_POST['nid']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
	$faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
	$school = mysqli_real_escape_string($conn, $_POST['school']);
	$dept = mysqli_real_escape_string($conn, $_POST['dept']);
	$qual = mysqli_real_escape_string($conn, $_POST['qual']);
	//$salary = mysqli_real_escape_string($conn, $_POST['salary']);





	// $result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`email`='$email',`password`='$email',`gender`='$gender',`contact`='$contact',`nid`='$nid',`salary`='$salary',`address`='$address',`dept`='$dept',`degree`='$degree' WHERE id=$id");


$result = mysqli_query($conn, "UPDATE `employee` SET `firstName`='$firstname',`lastName`='$lastname',`email`='$email',`birthday`='$birthday',`gender`='$gender',`contact`='$contact',`nid`='$nid',`address`='$address',`dept`='$dept',`qual`='$qual' WHERE id=$id");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    window.location.href='viewemp.php';
    </SCRIPT>");


	
}
?>




<?php
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * from `employee` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	if($result){
	while($res = mysqli_fetch_assoc($result)){
    $firstname = $res['firstName'];
	$staffid = $res['staffid'];
	$lastname = $res['lastName'];
	$email = $res['email'];
	$contact = $res['contact'];
	$address = $res['address'];
	$gender = $res['gender'];
	$birthday = $res['birthday'];
	$nid = $res['nid'];
    $college = $res['college'];
	$faculty = $res['faculty'];
    $school = $res['school'];
	$dept = $res['dept'];
	$qual = $res['qual'];
	
}
}

?>

<html>
<head>
	<title>View Employee |  Admin Panel | SGS SMS</title>
	<!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>
<body>
	<header>
		<nav>
			<h1>EMS</h1>
			<ul id="navli">
				<li><a class="homeblack" href="index.html">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homered" href="viewemp.php">View Employee</a></li>
				<li><a class="homeblack" href="elogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>
	

		<!-- <form id = "registration" action="edit.php" method="POST"> -->
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Update Supervisor Info</h2>
                    <form id = "registration" action="edit.php" method="POST">

                        <div class="row row-space">
                        <div class="col-2">
                            <label>First Name </label>
                                <div class="input-group">
                                     <input class="input--style-1" type="text" name="firstname" value="<?php echo $firstname;?>" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                            <label>Staff ID </label>
                                <div class="input-group">
                                     <input class="input--style-1" type="text" name="staffid" value="<?php echo $staffid;?>" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                            <label>Last Name </label>
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="lastName" value="<?php echo $lastname;?>" readonly>
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                        <label>Email</label>
                            <input class="input--style-1" type="email"  name="email" value="<?php echo $email;?>" readonly>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                            <label>Date of Birth </label>
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="birthday" value="<?php echo $birthday;?>" readonly>
                                   
                                </div>
                            </div>
                            <div class="col-2">
                            <label>Gender </label>
                                <div class="input-group">
									<input class="input--style-1" type="text" name="gender" value="<?php echo $gender;?>" readonly>
                                </div>
                            </div>
                        </div>
                        <label>Contact </label>
                        <div class="input-group">
                            <input class="input--style-1" type="number" name="contact" value="<?php echo $contact;?>">
                        </div>
                        <label>National ID </label>
                        <div class="input-group">
                            <input class="input--style-1" type="number" name="nid" value="<?php echo $nid;?>" readonly>
                        </div>

                        <label>Address </label>
                         <div class="input-group">
                            <input class="input--style-1" type="text"  name="address" value="<?php echo $address;?>">
                        </div>
                        <label>College </label>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="college" value="<?php echo $college;?>">
                        </div>
                        <label>Faculty </label>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="faculty" value="<?php echo $faculty;?>">
                        </div>

                        <label>School </label>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="school" value="<?php echo $school;?>">
                        </div>
                        <label>Department </label>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="dept" value="<?php echo $dept;?>">
                        </div>
                    

                        <label>My Qualification </label>
                        <div class="input-group">
                            <input class="input--style-1" type="text" name="qual" value="<?php echo $qual;?>" readonly>
                        </div>
                        <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Jquery JS-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
   
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

   
    <script src="js/global.js"></script> -->
</body>
</html>
