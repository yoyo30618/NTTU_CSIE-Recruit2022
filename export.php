<?php
header("Content-Type:text/html;charset=utf-8");
session_start();
if(isset($_COOKIE['Uname']))
{
	//已經登入
	if($_COOKIE['Ulogin']=="管理員")
	{
		require("conn_mysql.php");
		$output = "<html xmlns:x='urn:schemas-microsoft-com:office:excel'>";
		$output .= "<body>";
		$sql="SELECT * FROM `candidate` ORDER BY `candidate`.`Class` ASC, `candidate`.`Time` ASC, `candidate`.`round` ASC";
		$result=mysqli_query($db_link,$sql);
		if(mysqli_num_rows($result) > 0)
		{
			$output .= '
				<table>
				<tr>
					<th>准考證號</th>
					<th>身分證</th>
					<th>身分</th>
					<th>姓名</th>
					<th>場次</th>
					<th>梯次</th>
					<th>報到狀態</th>
					<th>編號</th>
					<th>題目一</th>
					<th>題目二</th>
					<th>題目三</th>
					<th>題目四</th>
					<th>題目五</th>
					<th>分數</th>
					<th>註記</th>
				</tr>
			';
			while($row = mysqli_fetch_array($result))
			{
				if($row[8]=="0")$r8="未選擇";
				if($row[8]=="1")$r8="軟體設計與應用";
				if($row[8]=="2")$r8="嵌入式系統與應用";
				if($row[8]=="3")$r8="網路通訊與應用";
				$output .= '
					<tr>
						<td align=center>'.$row[0].'</td>
						<td align=center>'.$row[1].'</td>
						<td align=center>'.$row[2].'</td>
						<td align=center>'.$row[3].'</td>
						<td align=center>'.$row[4].'</td>
						<td align=center>'.$row[5].'</td>
						<td align=center>'.$row[6].'</td>
						<td align=center>'.$row[7].'</td>
						<td align=center>'.$r8.'<br>'.$row[9].'</td>
						<td align=center>'.$row[10].'</td>
						<td align=center>'.$row[11].'</td>
						<td align=center>'.$row[12].'</td>
						<td align=center>'.$row[13].'</td>
						<td align=center>'.$row[14].'</td>
						<td align=center>'.$row[15].'</td>
					</tr>
				';
			}
			$output .= '</table>';
			$output .= "</body>";
			$output .= "</html>";
			header('Content-Type: application/xls');
			header('Content-Disposition: attachment; filename=考試資料.xls');
			echo $output;
		}
	}
	else
		echo"<script language=\"JavaScript\">alert('當前帳號無權訪問此頁面');location.href=\"index.php\";</script>";
}
else
{
	echo"<script language=\"JavaScript\">alert('請先登入');location.href=\"loginpage.php\";</script>";
}
?>
