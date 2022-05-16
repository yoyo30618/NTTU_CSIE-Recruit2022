<?php
	header("Content-Type:text/html;charset=utf-8");
		require("conn_mysql.php");
	if(isset($_POST['NewData']))
	{
		$SQL_NewDATA="SELECT * FROM `Candidate` WHERE `Class`=\"".$_POST['class']."\"and`Time`=\"".$_POST['time']."\"and`round`=\"".$_POST['round']."\"";

		$NewDATA_result_status=mysqli_query($db_link,$SQL_NewDATA) or die("查詢失敗");
		$sql_updatedata="";
		while ($NewDATA_rowres = mysqli_fetch_array($NewDATA_result_status, MYSQLI_BOTH))
		{
			if($NewDATA_rowres [6]=="開始面試")
				$sql_updatedata="UPDATE  `Candidate` SET `CheckIn`=\"回饋填寫中\",`Score`=\"".$_POST[$NewDATA_rowres[0]."_score"]."\",`Notice`=\"".$_POST[$NewDATA_rowres[0]."_stunotice"]."\" WHERE `ExamID`=\"".$NewDATA_rowres[0]."\"";
			else
				$sql_updatedata="UPDATE  `Candidate` SET `Score`=\"".$_POST[$NewDATA_rowres[0]."_score"]."\",`Notice`=\"".$_POST[$NewDATA_rowres[0]."_stunotice"]."\" WHERE `ExamID`=\"".$NewDATA_rowres[0]."\"";

			$update_data=mysqli_query($db_link,$sql_updatedata);
		}
		echo"<script language=\"JavaScript\">alert('分數登記完成');location.href=\"elements.php\";</script>";
	}
?>