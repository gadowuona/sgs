
<?php

require_once ('dbh.php');

$pname = $_POST['pname'];
$staffid = $_POST['staffid'];
$subdate = $_POST['subdate'];
$duedate = $_POST['duedate'];
$status = $_POST['status'];

$sql = "INSERT INTO `project`(`pname`, `staffid`,`subdate`,`duedate`,`status`) VALUES (`$pname` , `$staffid` ,`$subdate`,`$duedate`,`$status`)";

$result = mysqli_query($conn, $sql);


if(($result) == 1){
    
    
    header("Location: ..//assignproject.php");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Assign')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

?>