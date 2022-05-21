<?php
	header("Content-Type:text/html;charset=utf-8");
	require("conn_mysql.php");
	$sql_status="SELECT * FROM `candidate` WHERE 1";
	$result_status=mysqli_query($db_link,$sql_status) or die("查詢失敗");
	while ($rowres = mysqli_fetch_array($result_status, MYSQLI_BOTH))
	{
		$Cid = "C_".trim($rowres[0]);
		$id = trim($rowres[0]);
		if(isset($_POST[$rowres[0]]))
		{
			if($rowres[6]=="抵達420")
				$sql_StatusChange="UPDATE candidate SET Checkin =\"開始面試\" WHERE ExamID=\"".$id."\"";
			$result3=mysqli_query($db_link,$sql_StatusChange) or die("修改失敗");
			if(isset($_POST['time']))
				echo"<script language=\"JavaScript\">alert('".$id." ".$rowres[3]." 已入場面試');location.href=\"status_420.php?time=".$_POST['time']."\";</script>";
			else
				echo"<script language=\"JavaScript\">alert('".$id." ".$rowres[3]." 已入場面試');location.href=\"status_420.php\";</script>";
		}
		else if(isset($_POST[$Cid]))
		{
			$sql_StatusChange="UPDATE candidate SET Checkin =\"抵達420\" WHERE ExamID=\"".$id."\"";
			$result3=mysqli_query($db_link,$sql_StatusChange) or die("修改失敗");
			if(isset($_POST['time']))
				echo"<script language=\"JavaScript\">alert('".$id." ".$rowres[3]." 已成功修正');location.href=\"status_420.php?time=".$_POST['time']."\";</script>";
			else
				echo"<script language=\"JavaScript\">alert('已成功修正');location.href=\"status_420.php\";</script>";
		}
	}		
	echo"<script language=\"JavaScript\">location.href=\"index.php\";</script>";
	
?>