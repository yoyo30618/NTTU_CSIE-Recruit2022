<?php
	header("Content-Type:text/html;charset=utf-8");
		require("conn_mysql.php");
		$SQL_DATA="SELECT * FROM `candidate` WHERE `Time`=\"".$_POST['time']."\"";
		$DATA_result_status=mysqli_query($db_link,$SQL_DATA) or die("查詢失敗");
		$sql_updatedata="";
		if($_COOKIE['Uname']=='nttucsieadmin'||$_COOKIE['Uname']=='nttucsieadmin2'||$_COOKIE['Uname']=='cwlee')
		{
			$score='one_score';
			$notice='one_notice';
		}
		else
		{
			$score='two_score';
			$notice='two_notice';
		}
	while ($DATA_rowres = mysqli_fetch_array($DATA_result_status, MYSQLI_BOTH)){

		if(isset($_POST[$DATA_rowres[0]."_score"])){
			if($DATA_rowres [6]=="開始面試")
				$sql_updatedata="UPDATE  `candidate` SET `CheckIn`=\"回饋填寫中\",`$score`=\"".$_POST[$DATA_rowres[0]."_score"]."\",`$notice`=\"".$_POST[$DATA_rowres[0]."_stunotice"]."\" WHERE `ExamID`=\"".$DATA_rowres[0]."\"";
			else
				$sql_updatedata="UPDATE  `candidate` SET `$score`=\"".$_POST[$DATA_rowres[0]."_score"]."\",`$notice`=\"".$_POST[$DATA_rowres[0]."_stunotice"]."\" WHERE `ExamID`=\"".$DATA_rowres[0]."\"";
			$update_data=mysqli_query($db_link,$sql_updatedata);
		}
	}
	echo"<script language=\"JavaScript\">alert('分數登記完成');location.href=\"interview.php?time=".$_POST['time']."\";</script>";
	
?>
