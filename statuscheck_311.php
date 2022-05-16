<?php
	header("Content-Type:text/html;charset=utf-8");
	require("conn_mysql.php");
	$sql_status="SELECT * FROM `Candidate` WHERE 1";
	$result_status=mysqli_query($db_link,$sql_status) or die("查詢失敗");
	while ($rowres = mysqli_fetch_array($result_status, MYSQLI_BOTH))
	{
		$Cid = "C_".trim($rowres[0]);
		$id = trim($rowres[0]);
		if(isset($_POST[$rowres[0]]))
		{
			if($rowres[6]=="前往311...")
				$sql_StatusChange="UPDATE Candidate SET Checkin =\"等待面試中\" WHERE ExamID=\"".$id."\"";
			$result3=mysqli_query($db_link,$sql_StatusChange) or die("修改失敗");
			echo"<script language=\"JavaScript\">alert('".$id." ".$rowres[1]." 已成功抵達311');location.href=\"status_311.php\";</script>";
		}
		else if(isset($_POST[$Cid]))
		{
			$sql_StatusChange="UPDATE Candidate SET Checkin =\"前往311...\" WHERE ExamID=\"".$id."\"";
			$result3=mysqli_query($db_link,$sql_StatusChange) or die("修改失敗");
			echo"<script language=\"JavaScript\">alert('已成功修正');location.href=\"status_311.php\";</script>";
		}
	}		
	echo"<script language=\"JavaScript\">location.href=\"index.php\";</script>";
	
?>