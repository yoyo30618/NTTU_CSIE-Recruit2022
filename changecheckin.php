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
			if($rowres[6]=="他還沒來")
				$sql_StatusChange="UPDATE candidate SET Checkin =\"302填寫中\" WHERE ExamID=\"".$id."\"";
			else if($rowres[6]=="已去面試")
				$sql_StatusChange="UPDATE candidate SET Checkin =\"他還沒來\" WHERE ExamID=\"".$id."\"";
			$result3=mysqli_query($db_link,$sql_StatusChange) or die("修改失敗");
			$rowres[5] = (int)$rowres[5];
			$rowres[7] = (int)$rowres[7];
			if(isset($_POST['time']))
				echo"<script language=\"JavaScript\">alert('".$id." ".$rowres[3]." 已成功報到，第".$rowres[5]."梯，第".$rowres[7]."號');location.href=\"checkin.php?time=".$_POST['time']."\";</script>";
			else
				echo"<script language=\"JavaScript\">alert('".$id." ".$rowres[3]." 已成功報到，第".$rowres[5]."梯，第".$rowres[7]."號');location.href=\"checkin.php\";</script>";
		}
		else if(isset($_POST[$Cid]))
		{
			$sql_StatusChange="UPDATE candidate SET Checkin =\"他還沒來\" WHERE ExamID=\"".$id."\"";
			$result3=mysqli_query($db_link,$sql_StatusChange) or die("修改失敗");
			if(isset($_POST['time']))
				echo"<script language=\"JavaScript\">alert('已成功修正');location.href=\"checkin.php?time=".$_POST['time']."\";</script>";
			else if(isset($_GET['time']))
				echo"<script language=\"JavaScript\">alert('已成功修正');location.href=\"checkin.php?time=".$_POST['time']."\";</script>";
			else
				echo"<script language=\"JavaScript\">alert('已成功修正');location.href=\"checkin.php\";</script>";
		}
	}
	if(isset($_POST['time']))
		echo"<script language=\"JavaScript\">location.href=\"index.php?time=".$_POST['time']."\";</script>";
	else if(isset($_GET['time']))
		echo"<script language=\"JavaScript\">location.href=\"index.php?time=".$_POST['time']."\";</script>";
	else
		echo"<script language=\"JavaScript\">location.href=\"index.php\";</script>";

?>
