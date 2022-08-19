<?php
  
// Get the user id 
$staffid = $_REQUEST['staffid'];
  
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ems");
  
if ($staffid !== "") {
      
    // Get corresponding first name and 
    // last name for that user id    
    $query = mysqli_query($conn, "SELECT firstName, lastName FROM employee WHERE staffid='$staffid'");
  
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


