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
							if ($_COOKIE['Ulogin']=="管理員"||$_COOKIE['Ulogin']=="管理員2"||$_COOKIE['Ulogin']=="class4")
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
						if($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Ulogin']=='管理員2'||$_COOKIE['Ulogin']=='考生')
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
					if ($_COOKIE['Ulogin']=='class4') {
					?>
					<li><a href="status_420.php">考生狀態(420使用)</a></li>
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
				<div class="inner">
					<h2>考生目前狀態(420使用)</h2>
					<h3><font style="background:#CAFFBF">"綠格"</font>正在等待面試</h3>
					<h3>開始面試後請變更為<font style="background:#9BF6FF">"藍格"</font></h3>
					<hr>
					<h3>
					<font style="background:#F0EFEB">他還沒來</font>
					(三樓電梯報到)-><font style="background:#FFADAD">302填寫中</font>
					(填寫後自動偵測)-><font style="background:#FFD6A5">402等待面試中</font>
					(時間到請至420)<br>-><font style="background:#CAFFBF">抵達420</font>
					(進入考場面試)-><font style="background:#9BF6FF">開始面試</font>
					(面試完畢後)-><font style="background:#A0C4FF">回饋填寫中</font>
					(403填寫回饋並領取紀念品)-><font style="background:#FFC6FF">面試完畢</font>
					<form method="get" style="width:100%;" action="">
						<?php
							if(isset($_GET['RefreshData']))
							{
								$SQL_DATA="SELECT * FROM `candidate` WHERE `Time`=\"".$_GET['time']."\" ORDER BY `candidate`.`Time` ASC, `candidate`.`round` ASC , `candidate`.`Number` ASC";
								$DATA_result_status=mysqli_query($db_link,$SQL_DATA) or die("查詢失敗");
							}
						?>
						<div class="select-wrapper">
							<select name="time"style="width:80%;float:left">
								<option value="*"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="*")) 
											echo "selected";
									?>
								>ALL</option>								
								<option value="01"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="01")) 
											echo "selected";
									?>
								>01</option>
								<option value="02"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="02")) 
											echo "selected";
									?>
								>02</option>
								<option value="03"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="03")) 
											echo "selected";
									?>
								>03</option>
								<option value="04"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="04")) 
											echo "selected";
									?>
								>04</option>
								<option value="05"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="05")) 
											echo "selected";
									?>
								>05</option>
								<option value="06"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="06")) 
											echo "selected";
									?>
								>06</option>
								<option value="07"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="07")) 
											echo "selected";
									?>
								>07</option>
								<option value="08"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="08")) 
											echo "selected";
									?>
								>08</option>
								<option value="09"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="09")) 
											echo "selected";
									?>
								>09</option>
								<option value="10"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="10")) 
											echo "selected";
									?>
								>10</option>
								<option value="11"
									<?php 
										if((isset($_GET['time'])&&$_GET['time']=="11")) 
											echo "selected";
									?>
								>11</option>
							</select>
							<button class="button special small" style="float:left;width:20%;padding:0 0.5em" name="RefreshData">查詢</button>
						</div>
					</form>
				</h3>
					<hr>
						<div class="12u">
							<div class="table-wrapper" style="color:black;">
								<form method="post" style="width:100%;" action="statuscheck_420.php">
									<?php if(isset($_GET['time'])){
											echo "<input type=\"hidden\" name=\"time\" value=\"".$_GET['time']."\">";
										}
									?>
									<table class="alt">
										<thead>
											<tr>
												<th style="text-align: center;">准考證號</th>
												<th style="text-align: center;">考生姓名</th>
												<th style="text-align: center;">梯次與(編號)</th>
												<th style="text-align: center;">現在狀態</th>
												<th style="text-align: center;">狀態調整</th>

											</tr>
										</thead>
										<tbody>
										<?php
											if(isset($_GET['time'])&&$_GET['time']!='*')
												$A_sql_status="SELECT * FROM `candidate` WHERE `Class`='T' and `Time`=".$_GET['time']." ORDER BY `candidate`.`Time` ASC, `candidate`.`round` ASC , `candidate`.`Number` ASC";
											else
												$A_sql_status="SELECT * FROM `candidate` WHERE `Class`='T' ORDER BY `candidate`.`Time` ASC, `candidate`.`round` ASC , `candidate`.`Number` ASC";
											$A_result_status=mysqli_query($db_link,$A_sql_status) or die("查詢失敗");
											while ($A_rowres = mysqli_fetch_array($A_result_status, MYSQLI_BOTH))
											{
												if($A_rowres[6]=="302填寫中")
													$Color="#FFADAD";
												else if($A_rowres[6]=="402等待面試中")
													$Color="#FFD6A5";
												else if($A_rowres[6]=="402等待面試中")
													$Color="#FDFFB6";
												else if($A_rowres[6]=="抵達420")
													$Color="#CAFFBF";
												else if($A_rowres[6]=="開始面試")
													$Color="#9BF6FF";
												else if($A_rowres[6]=="回饋填寫中")
													$Color="#A0C4FF";
												else if($A_rowres[6]=="面試完畢")
													$Color="#FFC6FF";

												else//他還沒來
													$Color="#F0EFEB";
												?>
												<tr>
													<td style="background-color:<?php echo $Color?>"><?php echo $A_rowres[0]?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $A_rowres[3]?></td>
														<td style="background-color:<?php echo $Color?>">T<?php echo $A_rowres[5]."-".$A_rowres[7]?></td>
													<td style="background-color:<?php echo $Color?>;height:80px;"><?php echo $A_rowres[6]?></td>
												<?php
													if($A_rowres[6]=="抵達420")
													{
												?>
														<td style="background-color:<?php echo $Color?>"><button name="<?php echo $A_rowres[0]?>">入場面試</button></td>
												<?php
													}
													else if($A_rowres[6]=="開始面試")
													{
												?>
														<td style="background-color:<?php echo $Color?>"><button name="<?php echo "C_".$A_rowres[0]?>" class="button special small" style="padding: 0 0.5em;">搞錯了</button></td>
												<?php
													}
													else
													{
													?>
														<td style="background-color:<?php echo $Color?>"> </td>
													<?php
													}

												?>
												</tr>
											<?php
											}?>
										</tbody>
									</table>
								</form>
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
