<!DOCTYPE HTML>

<html>
	<head>

		<title>東大資工面試報到</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<?php
			require("conn_mysql.php");
		?>
		<!-- Header -->
			<header id="header">
				<nav class="left">
					<a href="#menu"><span>目錄</span></a>
				</nav>
				<a href="index.php" class="logo">National Taitung University</a>
				<nav class="right">
					<?php
						header("Content-Type:text/html;charset=utf-8");
						session_start();
						if(isset($_COOKIE['Uname']))
						{
							//已經登入
							if($_COOKIE['Ulogin']=="管理員"||$_COOKIE['Ulogin']=="口試"||$_COOKIE['Ulogin']=="管理員2")
								echo "<a href='logout.php' class='button alt'>Log Out</a>";
							else
								echo"<script language=\"JavaScript\">alert('當前帳號無權訪問此頁面');location.href=\"index.php\";</script>";
						}
						else
						{
							echo"<script language=\"JavaScript\">alert('請先登入');location.href=\"loginpage.php\";</script>";
						}
					?>
				</nav>
			</header>

		<!-- Menu -->
			<nav id="menu">
				<ul class="links">
					<li><a href="index.php">首頁</a></li>

					<?php
						if($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Ulogin']=='管理員2')
						{
					?>
					<li><a href="survey.php">問卷作答(考生使用)</a></li>

					<?php
						}
					?>
					<?php
						if($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Ulogin']=='管理員2')
						{
					?>
						<li><a href="checkin.php">報到狀態(報到處使用)</a></li>
						<li><a href="status_302.php">填答狀態(C302使用)</a></li>
					<!--	<li><a href="status_311.php">考生狀態(C311使用)</a></li> -->
						<li><a href="status_402.php">考生狀態(C402使用)</a></li>
						<li><a href="status_420.php">考生狀態(C420使用)</a></li>
						<li><a href="status_403.php">考生狀態(C403使用)</a></li>
						<li><a href="interview.php">面試分數(面試考官使用)</a></li>
						<li><a href="elements.php">資料顯示(筆試考官使用)</a></li>

					<?php
						}
					?>
					<?php
						if($_COOKIE['Ulogin']=='口試')
						{
					?>

							<li><a href="elements.php">資料顯示(面試考官使用)</a></li>
							<li><a href="checkin.php">報到狀態(報到處使用)</a></li>
					<?php
						}
					?>
				</ul>
				<ul class="actions vertical">
					<?php
						header("Content-Type:text/html;charset=utf-8");
						if(isset($_COOKIE['Uname']))
						{
							//已經登入
							echo "<li><a href='logout.php' class='button fit'>Log out</a></li>";
						}
						else
						{
							echo "<li><a href='loginpage.php' class='button fit'>Login</a></li>";
						}
					?>
				</ul>
			</nav>

		<!-- Two -->
			<section id="two" class="wrapper  special">
				<div class="inner" style="max-width:95%">
					<h2>面試顯示(面試考官使用)</h2>

						<div class="12u">
							<div class="table-wrapper" style="color:black;width:100%;">
								<form method="get" style="width:100%;" action="">
									<?php
										if(isset($_GET['time']))
											$SQL_DATA="SELECT * FROM `candidate` WHERE `Time`=\"".$_GET['time']."\" ORDER BY `candidate`.`Time` ASC, `candidate`.`round` ASC , `candidate`.`Number` ASC";
										else
											$SQL_DATA="SELECT * FROM `candidate` WHERE `Time`=\"1\" ORDER BY `candidate`.`Time` ASC, `candidate`.`round` ASC , `candidate`.`Number` ASC";
										$DATA_result_status=mysqli_query($db_link,$SQL_DATA) or die("查詢失敗");

									?>
									<div class="select-wrapper">
										<select name="time"style="width:50%;float:left">

											<option value="01"<?php if(isset($_GET['time'])&&$_GET['time']=="01") echo "selected"?>>1</option>
											<option value="02"<?php if(isset($_GET['time'])&&$_GET['time']=="02") echo "selected"?>>2</option>
											<option value="03"<?php if(isset($_GET['time'])&&$_GET['time']=="03") echo "selected"?>>3</option>
											<option value="04"<?php if(isset($_GET['time'])&&$_GET['time']=="04") echo "selected"?>>4</option>
											<option value="05"<?php if(isset($_GET['time'])&&$_GET['time']=="05") echo "selected"?>>5</option>
											<option value="06"<?php if(isset($_GET['time'])&&$_GET['time']=="06") echo "selected"?>>6</option>
											<option value="07"<?php if(isset($_GET['time'])&&$_GET['time']=="07") echo "selected"?>>7</option>
											<option value="08"<?php if(isset($_GET['time'])&&$_GET['time']=="08") echo "selected"?>>8</option>
											<option value="09"<?php if(isset($_GET['time'])&&$_GET['time']=="09") echo "selected"?>>9</option>
											<option value="10"<?php if(isset($_GET['time'])&&$_GET['time']=="10") echo "selected"?>>10</option>
											<option value="11"<?php if(isset($_GET['time'])&&$_GET['time']=="11") echo "selected"?>>11</option>
										</select>
										<button class="button special small" style="float:left;width:20%;padding:0 0.5em" name="RefreshData">查詢</button>
									</div>
								</form>
								<form method="post" style="width:100%;" action="interviewsent.php">
									<?php
										if(isset($_GET['RefreshData']))
										{
										echo "<input type=\"hidden\" name=\"time\" value=\"".$_GET['time']."\">";
										}
									?>
									<table class="alt">
										<tbody>
											<tr>
													<th style="text-align: center;width:10%;"><div style="overflow:auto;width:100%;height:120px;">准考證號<br>姓名<br>梯次(編號)<br>考生狀態</div></th>
													<th style="text-align: center;width:20%;height:10%;"><div style="overflow:auto;width:100%;height:42px;">分數</div></th>
													<th style="text-align: center;width:30%;height:10%;"><div style="overflow:auto;width:100%;height:42px;">註記</div></th>
												</tr>

										<?php

											while ($DATA_rowres = mysqli_fetch_array($DATA_result_status, MYSQLI_BOTH))
											{
												if($DATA_rowres[6]=="302填寫中")
													$Color="#FFADAD";
												else if($DATA_rowres[6]=="402等待面試中")
													$Color="#FFD6A5";
												else if($DATA_rowres[6]=="402等待面試中")
													$Color="#FDFFB6";
												else if($DATA_rowres[6]=="抵達420")
													$Color="#CAFFBF";
												else if($DATA_rowres[6]=="開始面試")
													$Color="#9BF6FF";
												else if($DATA_rowres[6]=="回饋填寫中")
													$Color="#A0C4FF";
												else if($DATA_rowres[6]=="面試完畢")
													$Color="#FFC6FF";
												else//他還沒來
													$Color="#F0EFEB";
												?>

												<tr>
													<td rowspan="1" style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[0]."<br>".$DATA_rowres[3]."<br>T".$DATA_rowres[5]."-".$DATA_rowres[7]."<br>".$DATA_rowres[6]?></td>
													<?php
													if($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Uname']=='cwlee'){
													?>
													<td style="background-color:<?php echo $Color?>"><textarea name='<?php echo $DATA_rowres[0].'_score'?>'   placeholder='分數' rows='2' style=' resize: none;'><?php echo $DATA_rowres[37]?></textarea></td>
													<?php }
													if($_COOKIE['Ulogin']=='管理員2'||$_COOKIE['Uname']=='weiwenhsu'){
													?>
													<td style="background-color:<?php echo $Color?>"><textarea name='<?php echo $DATA_rowres[0].'_score'?>'   placeholder='分數' rows='2' style=' resize: none;'><?php echo $DATA_rowres[38]?></textarea></td>
													<?php }
													if($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Uname']=='cwlee'){
													?>
													<td style="background-color:<?php echo $Color?>"><textarea name='<?php echo $DATA_rowres[0].'_stunotice'?>'  placeholder='考生註記' rows='6' style=' resize: none;'><?php echo $DATA_rowres[39]?></textarea></td>
													<?php }
													if($_COOKIE['Ulogin']=='管理員2'||$_COOKIE['Uname']=='weiwenhsu'){
													?>
													<td style="background-color:<?php echo $Color?>"><textarea name='<?php echo $DATA_rowres[0].'_stunotice'?>'  placeholder='考生註記' rows='6' style=' resize: none;'><?php echo $DATA_rowres[40]?></textarea></td>
													<?php }
													?>
											<?php
											}?>
										</tbody>
									</table>
									<div style="width:100%;">
										<button class="button special small" style="float:center;width:10%;padding:0 0.3em" name="DATA">本梯次面試結束</button>
										<input type="hidden" value='<?php echo $_GET['time']?>' name="time">

									</div>
								</form>

									<div style="width:100%;">
										<button class="button small" style="float:center;width:10%;padding:0 0.3em"  onclick="location.href='export.php'">匯出所有資料</button>
									</div>



							</div>
						</div>
				</div>
			</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<h2>聯絡我們</h2>
					<ul class="actions">
						<li><span class="icon fa-phone"></span> <a href="#">(089)318855#6201</a></li>
						<li><span class="icon fa-envelope"></span> <a href="#"> chifu@nttu.edu.tw</a></li>
						<li><span class="icon fa-map-marker"></span>國立臺東大學 資訊工程學系</li>
					</ul>
				</div>
				<div class="copyright">
					&copy; Untitled. Design 資工碩一11001903劉紀佑<br/>
					&copy; Untitled. Design 資工二甲10911147莊冠霖<br/>
					&copy; Untitled. Design 資工二甲10911149陳奕翔
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
