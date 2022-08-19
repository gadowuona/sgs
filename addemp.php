<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Add Employee | SGS Supervisors Management System</title>

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
                <li><a class="homeblack" href="aloginwel.php">HOME</a></li>
                <li><a class="homered" href="addemp.php">Add Employee</a></li>
                <li><a class="homeblack" href="viewemp.php">View Employee</a></li>
                <li><a class="homeblack" href="assign.php">Assign Project</a></li>
                <li><a class="homeblack" href="assignproject.php">Project Status</a></li>
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
                    <h2 class="title">Supervisor Registration Info</h2>
                    <form action="process/addempprocess.php" method="POST" enctype="multipart/form-data">


                        

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="Staff ID" name="staffid" required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="First Name" name="firstName" required="required">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="Middle Name" name="middleName">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Last Name" name="lastName" required="required">
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email" required="required">
                        </div>
                        <p>Birthday</p>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="BIRTHDATE" name="birthday" required="required">
                                   
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="gender">
                                            <option disabled="disabled" selected="selected">GENDER</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Contact Number" name="contact" required="required" >
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="National ID" name="nid" required="required">
                        </div>

                        
                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Address" name="address">
                        </div>

                        <div class="rs-select2 js-select-simple select--no-search">
                            <label>College</label>
                                        <select name="college">
                                            <option disabled="disabled" selected="selected">Select your College</option>
                                            <option value="college of humanities and legal studies">College of Humanities and Legal Studies</option>
                                            <option value="college of health and allied sciences">College of Health and Allied Sciences</option>
                                            <option value="college of distance education">College of Distance Education</option>
                                            <option value="college of education studies">College of Education Studies</option>
                                            <option value="college of agricultural and natural sciences">College of Agricultural and Natural Sciences</option>
                                            </select>
                                        <div class="select-dropdown"></div>
                                    </div> <br>

                        <div class="rs-select2 js-select-simple select--no-search">
                        <label>Faculty/School</label>
                                        <select name="fns">
                                            <option disabled="disabled" selected="selected">Select your Faculty/School</option>
                                            <option value="faculty">Faculty</option>
                                            <option value="school">School</option>
                                            </select>
                                        <div class="select-dropdown"></div>
                                    </div> <br>


                                    
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Enter your Faculty/School" name="faculty" required="required">
                        </div><br>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Department" name="dept" required="required">
                        </div><br>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Qualification" name="qual" required="required">
                        </div><br>
<!--
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Supervision Status" name="super_status" required="required">
                        </div><br>
-->
                        <div class="input-group">
                        <label>Upload your passport pic</label>
                            <input class="input--style-1" type="file" placeholder="file" name="file">
                        </div>







                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
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
