<?php
	header("Content-Type:text/html;charset=utf-8");
	require("conn_mysql.php");
	
	$sql_AnsReset="UPDATE `candidate` SET `Qc1`=\"0\" WHERE `ExamID`='".$_COOKIE['Uname']."'";
	$result1=mysqli_query($db_link,$sql_AnsReset) or die("查詢失敗1");
	echo"<script language=\"JavaScript\">location.href=\"survey.php\";</script>";
?>