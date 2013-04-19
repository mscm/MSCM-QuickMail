<?php
//includes for database connection and session handling
include("config.php");

$user = $_SESSION['username'];

//regex split of post var to get class and section
list($class, $section) = preg_split("/\s+/", $_POST['class_code']); 

//SQL query for faculty email address
$faculty_email_query = sqlsrv_query ($conn, "

SELECT SyStaff.email FROM SyStaff
WHERE SyStaff.Code like '$user'

");

//retrieving results
$row = sqlsrv_fetch_array($faculty_email_query, SQLSRV_FETCH_ASSOC);
$faculty_email = $row[email];

//SQL query for student email addresses
if ($class == 'all_classes') {
  $query2 = sqlsrv_query ($conn, "
  
  DECLARE @CurDate datetime = GETDATE()

  SELECT DISTINCT adEnrollSched.SyStudentID, SyStudent.email

  FROM SyStudent

  right join AdEnrollSched on AdEnrollSched.SyStudentID = SyStudent.SyStudentId
  left join AdCourse on AdEnrollSched.AdCourseID = AdCourse.AdCourseID
  left join AdClassSched on AdEnrollSched.AdClassSchedID = AdClassSched.AdClassSchedID
  left join AdTerm on AdEnrollSched.AdTermID = AdTerm.AdTermID
  left join SyStaff on AdTeacherID = SyStaff.SyStaffID

  WHERE SyStaff.Code = '$user'
  AND
  @CurDate BETWEEN DATEADD(day, -5,CAST(Adterm.StartDate AS datetime)) AND DATEADD(day,10,CAST(AdTerm.EndDate as datetime))
  AND
  AdEnrollSched.Status <> 'D'

  ");

  }else{
  $query = sqlsrv_query ($conn, "

  DECLARE @CurDate datetime = GETDATE()

  SELECT adEnrollSched.SyStudentID, SyStudent.email, AdEnrollSched.AdTermID, adcourse.Code, AdClassSched.Section

  from SyStudent

  right join AdEnrollSched on AdEnrollSched.SyStudentID = SyStudent.SyStudentId
  left join AdCourse on AdEnrollSched.AdCourseID = AdCourse.AdCourseID
  left join AdClassSched on AdEnrollSched.AdClassSchedID = AdClassSched.AdClassSchedID
  left join AdTerm on AdEnrollSched.AdTermID = AdTerm.AdTermID

  WHERE (Adcourse.code = '$class' and section = '$section')
  AND
  @CurDate BETWEEN DATEADD(day, -5,CAST(Adterm.StartDate AS datetime)) AND DATEADD(day,10,CAST(AdTerm.EndDate as datetime))
  AND
  AdEnrollSched.Status <> 'D'

  "); 
}

//build address list array to push specific results from SQL query
$ar_addy_list = array(); 

//Loop through returned rows array and push values into new array defined above
if ($class == 'all_classes') {
    while($row = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)) {
	    array_push($ar_addy_list, $row[email]);
    }
  }else{
    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
	    array_push($ar_addy_list, $row[email]);
    }
}

//convert array into a simple string and assign to $addy_list variable
$addy_list = implode(", ", $ar_addy_list);

//Build screen output
echo "<head><link href='css/qmail.css' rel='stylesheet' type='text/css' /></head>";
echo "<h2>Your message has been sent to the following:<br></h2>";
echo $addy_list."<br>";
echo "<br>Click <a href='logout.php'>here</a> to logout ".$_SESSION['username']." or <a href='compose.php'>write</a> another message.";

//building email message
$headers = "Cc:".$faculty_email."\r\n";
$headers .= "Content-type: text/html\r\n";
$headers .= "From:".$faculty_email."\r\n";
$headers .= "Reply-To:".$faculty_email."\r\n";
$headers .= "Return-Path:".$faculty_email."\r\n";

if (ENABLED == 'true'){
    mail($addy_list,$_POST['subject'],$_POST['message'],$headers);
  }elseif (ENABLED == 'false') {
    echo "<br><h1>QuickMail is currently disabled. Please contact ".SUPPORT_EMAIL.".</h1>";
  }else {
    echo "<br><h1>QuickMail is not properly configured. Please contact ".SUPPORT_EMAIL.".</h1>";
  }
?> 
