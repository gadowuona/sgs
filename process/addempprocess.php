<?php

require_once ('dbh.php');

$staffid = $_POST['staffid'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$nid = $_POST['nid'];
$college = $_POST['college'];
$fns = $_POST['fns'];
$dept = $_POST['dept'];
$qual = $_POST['qual'];
$super_status = $_POST['super_status'];
$birthday =$_POST['birthday'];
//echo "$birthday";
$files = $_FILES['file'];
$filename = $files['name'];
$filrerror = $files['error'];
$filetemp = $files['tmp_name'];
$fileext = explode('.', $filename);
$filecheck = strtolower(end($fileext));
$fileextstored = array('png' , 'jpg' , 'jpeg');

if(in_array($filecheck, $fileextstored)){

    $destinationfile = 'images/'.$filename;
    move_uploaded_file($filetemp, $destinationfile);

    $sql = "INSERT INTO `employee`(`id`, `staffid`,`firstName`, `middleName`,`lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `nid`,  `address`, `college`, `fns`,`dept`, `qual`, `super_status`,`pic`) VALUES ('','$staffid','$firstName','$middleName','$lastName','$email','sgs@1234','$birthday','$gender','$contact','$nid','$address','$college','$fns','$dept','$qual','$super_status','$destinationfile')";

$result = mysqli_query($conn, $sql);


if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered')
    window.location.href='..//viewemp.php';
    </SCRIPT>");
    //header("Location: ..//aloginwel.php");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Register')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

}

else{

      $sql = "INSERT INTO `employee`(`id`, `staffid`, `firstName`, `middleName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `nid`,  `address`, `college`,`fns`,`dept`, `qual`, `super_status`,`pic`) VALUES ('','$staffid','$firstName','$middleName','$lastName','$email','sgs@1234','$birthday','$gender','$contact','$nid','$address','$college','$fns','$dept','$qual','$super_status','images/no.jpg')";

$result = mysqli_query($conn, $sql);



if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered')
    window.location.href='..//viewemp.php';
    </SCRIPT>");
    //header("Location: ..//aloginwel.php");
}

// else{
//     echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Failed to Registere')
//     window.location.href='javascript:history.go(-1)';
//     </SCRIPT>");
// }
}






?>