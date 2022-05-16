<?php
	header("Content-Type:text/html;charset=utf-8");
	require("conn_mysql.php");
	if(isset($_POST['SetAns']))
	{
		$pattern = array('/ /','/　/','/\r\n/','/\n/');
		$replace = array(' ',' ','<br />');
		$Qc1 = ($_POST['Qc1']);
		$Q1=preg_replace($pattern, $replace, $_POST['Q1']); 
		$Q2=preg_replace($pattern, $replace, $_POST['Q2']); 
		$Q3=preg_replace($pattern, $replace, $_POST['Q3']); 
		
		
		$sql_AnsSet="UPDATE Candidate SET Qc1 =\"".$Qc1."\",Checkin =\"前往311...\",Q1 =\"".$Q1."\",Q2 =\"".$Q2."\",Q3 =\"".$Q3."\" WHERE ExamID=\"".$_COOKIE['Uname']."\"";
		$result3=mysqli_query($db_link,$sql_AnsSet) or die("填寫失敗");
		echo"<script language=\"JavaScript\">alert('填寫完畢，請查看狀態');location.href=\"survey.php\";</script>";		
	}
	else		
		echo"<script language=\"JavaScript\">location.href=\"index.php\";</script>";
	
	
?>