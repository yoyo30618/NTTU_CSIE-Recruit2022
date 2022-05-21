<?php
	header("Content-Type:text/html;charset=utf-8");
	session_start();

	if(isset($_POST['trylogin']))
	{
		require("conn_mysql.php");
		$Uname = trim($_POST['Uname']);
		$Upwd = trim($_POST['Upwd']);
		$check="0";
		$GroupID="-1";
		$sql_query_login="SELECT * FROM administrator where account='$Uname'";
		$result1=mysqli_query($db_link,$sql_query_login) or die("查詢失敗1");
		while($row=mysqli_fetch_array($result1))
		{
			if($row[1]==$Upwd)
			{
				$check="1";
				$Group=$row[2];
				$sql_query_name="SELECT Name FROM candidate where ExamID='$Uname'";
				$resultName=mysqli_query($db_link,$sql_query_name) or die("查詢失敗2");
				$rowName=mysqli_fetch_array($resultName);
				$wname = $rowName[0];
				if($Group=="考生")//偷存編號
				{
					$sql_query_Group="SELECT * FROM candidate where ExamID='$Uname'";
					$resultGroup=mysqli_query($db_link,$sql_query_Group) or die("查詢失敗3");
					while($rowGroup=mysqli_fetch_array($resultGroup))
					{
						$GroupID=$rowGroup[0];
						$Round=(int)$rowGroup[5];
						break;
					}
				}
				break;
			}
		}
		if(($Uname=='')||($Upwd==''))
		{
			echo"<script language=\"JavaScript\">alert('准考證號或身分證字號輸入錯誤');location.href=\"loginpage.php\";</script>";
		}
		else if(($check=="1"))
		{
			//登入成功將資訊儲存到session中
			$_SESSION['Uname']=$Uname;
			$_SESSION['Ulogin']=$Group;
			$_SESSION['UloginID']=$GroupID;
			$_SESSION['wname']=$wname;
			setcookie("Uname",$Uname);
			setcookie("Ulogin",$Group);
			setcookie("GroupID",$GroupID);
			setcookie("Round",$Round);
			setcookie("wname",$wname);
			//跳轉到使用者首頁
			header('refresh:0;url=index.php');
		}
		else
		{
			echo"<script language=\"JavaScript\">alert('准考證號或身分證字號輸入錯誤');location.href=\"loginpage.php\";</script>";
		}
	}
	echo"<script language=\"JavaScript\">location.href=\"index.php\";</script>";
?>
