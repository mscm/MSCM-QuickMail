<?php

//includes for database connection and session handling
include("config.php");

$user = $_SESSION['username'];

$query = sqlsrv_query($conn, " 

DECLARE @CurDate datetime = GETDATE()

select DISTINCT AdCourse.AdCourseID, Adcourse.Code, AdClassSched.Section  from AdEnrollSched 
left join AdClassSched on AdEnrollSched.AdClassSchedID = AdClassSched.AdClassSchedID
left join ADCourse on AdClassSched.AdCourseID = Adcourse.AdCourseID
left join AdTerm on AdEnrollSched.AdTermID = AdTErm.AdTermID
left join SyStaff on AdTeacherID = SyStaff.SyStaffID

where SyStaff.Code like '$user'
and @CurDate BETWEEN DATEADD(day,-".DAYS_BEFORE.",CAST(Adterm.StartDate AS datetime)) AND DATEADD(day,".DAYS_AFTER.",CAST(AdTerm.EndDate as datetime))

"); 
echo "<head><link href='css/qmail.css' rel='stylesheet' type='text/css' /></head>";
echo "<script type='text/javascript' src='js/nicEdit.js'></script><script type='text/javascript'>bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });</script>";
echo "<form action='sendmail.php' method='post'>"; //build html form
;
//Loop through returned rows array and print data based on "email" field name
WHILE ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) 	{

	echo "<input type=radio value='".$row[Code].$row[Section]."' name=class_code>".$row[Code].$row[Section]."<br>";
}

echo "<input type=radio value='all_classes' name=class_code>All Classes<br />";

echo "<br>";

echo "Subject:<input type='text' name='subject'><br><br>
	<textarea name='message' rows='15' style='width: 75%';></textarea><br><br>
	<input type='submit' value='Send'>";

echo "</form><br>";

echo "<br>Click <a href='logout.php'>here</a> to logout ".$_SESSION['username'];

?>

