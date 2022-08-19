<?php
  
// Get the user id 
$staffid = $_REQUEST['staffid'];
  
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ems");
  
if ($staffid !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($conn, "SELECT firstName, 
    lastName FROM employee WHERE staffid='$staffid'");
  
    $row = mysqli_fetch_array($query);
  
    // Get the first name
    $firstName = $row["firstName"];
  
    // Get the first name
    $lastName = $row["lastName"];
}
  
// Store it in a array
$result = array("$firstName", "$lastName");
  
// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>



<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Assign Project | Admin Panel | SGS Supervisor's Management System</title>

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
            <h1>SGS- SMS</h1>
            <ul id="navli">
                <li><a class="homeblack" href="aloginwel.php">HOME</a></li>
                <li><a class="homeblack" href="addemp.php">Add Supervisor</a></li>
                <li><a class="homeblack" href="viewemp.php">View Supervisor</a></li>
                <li><a class="homered" href="assign.php">Assign Thesis</a></li>
                <li><a class="homeblack" href="assignproject.php">Thesis Status</a></li>
                <li><a class="homeblack" href="alogin.html">Log Out</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divider"></div>

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Assign Thesis/Dissertation</h2>
                    <form action="process/assignp.php" method="POST" enctype="multipart/form-data">

                    

                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Staff ID" name="staffid" required="required">
                        </div>


                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="name" name="name" readonly>
                        </div>


                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Thesis /Dissertation Title" name="pname" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Student Name(s)" name="studname" required="required">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label>Submission Date</label>
                                    <input class="input--style-1" type="date" placeholder="subdate" name="subdate" required="required">
                                   
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                <label>Due Date</label>
                                    <input class="input--style-1" type="date" placeholder="duedate" name="duedate">
                                   
                              <p>
                                    <br /> 
                                </p>
                            
                            
                                        <select name="status">
                                            <option disabled="disabled" selected="selected">Select Status</option>
                                            <option value="super_status">Supervisor</option>
                                            <option value="super_status">Co-Supervisor</option>
                                            </select>
                                        <div class="select-dropdown"></div>
                                    </div> <br>
                                    </div>
                            </div>
                       
                       
                       
                       
                       <!--
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="status" name="status" ">
                        </div>

                        -->

                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->



