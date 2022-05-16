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
							if($_COOKIE['Ulogin']=="管理員"||$_COOKIE['Ulogin']=="工作人員")
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
					<li><a href="survey.php">問卷作答(考生使用)</a></li>
					<?php
						if($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Ulogin']=='工作人員')
						{
					?>
						<li><a href="checkin.php">報到狀態(報到處使用)</a></li>
						<li><a href="status_302.php">填答狀態(C302使用)</a></li>
						<li><a href="status_311.php">考生狀態(C311使用)</a></li>
						<li><a href="status_5F.php">考生狀態(五樓使用)</a></li>
						<li><a href="status_5F_room.php">考生狀態(五樓考場外使用)</a></li>
						<li><a href="status_506.php">考生狀態(506使用)</a></li>
					<?php
						}
					?>
					<?php
						if($_COOKIE['Ulogin']=='管理員')
						{
					?>
							<li><a href="elements.php">資料顯示(考場內使用)</a></li>
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
					<h2>考生目前狀態(五樓考場外使用)</h2>
					<h3><font style="background:#CAFFBF">"綠格"</font>正在等待面試</h3>
					<h3>開始面試後請變更為<font style="background:#9BF6FF">"藍格"</font></h3>
					<hr>
					<h3>
					<font style="background:#F0EFEB">他還沒來</font>
					(三樓電梯報到)-><font style="background:#FFADAD">302填寫中</font>
					(填寫後自動偵測)-><font style="background:#FFD6A5">前往311...</font>
					(抵達311)-><font style="background:#FDFFB6">等待面試中</font>
					(時間到請至五樓)<br>-><font style="background:#CAFFBF">抵達五樓</font>
					(進入考場面試)-><font style="background:#9BF6FF">開始面試</font>
					(面試完畢後)-><font style="background:#A0C4FF">回饋填寫中</font>
					(506填寫回饋並領取紀念品)-><font style="background:#FFC6FF">面試完畢</font>
					</h3>
					<hr>
						<div class="12u">
							<div class="table-wrapper" style="color:black;">
								<form method="post" style="width:100%;" action="statuscheck_5F_room.php">
									<table class="alt">
										<thead>
											<tr>
												<th style="text-align: center;">准考證號</th>
												<th style="text-align: center;">考生姓名</th>
												<th style="text-align: center;">梯次與場次</th>
												<th style="text-align: center;">現在狀態</th>
												<th style="text-align: center;">狀態調整</th>
												<th style="text-align: center;">准考證號</th>
												<th style="text-align: center;">考生姓名</th>
												<th style="text-align: center;">梯次與場次</th>
												<th style="text-align: center;">現在狀態</th>
												<th style="text-align: center;">狀態調整</th>
											</tr>
										</thead>
										<tbody>
										<?php
										
											$A_sql_status="SELECT * FROM `Candidate` WHERE `Class`='A' ORDER BY `Candidate`.`Time` ASC, `Candidate`.`round` ASC , `Candidate`.`Number` ASC";
											$B_sql_status="SELECT * FROM `Candidate` WHERE `Class`='B' ORDER BY `Candidate`.`Time` ASC, `Candidate`.`round` ASC , `Candidate`.`Number` ASC";
											$A_result_status=mysqli_query($db_link,$A_sql_status) or die("查詢失敗");
											$B_result_status=mysqli_query($db_link,$B_sql_status) or die("查詢失敗");
											while ($A_rowres = mysqli_fetch_array($A_result_status, MYSQLI_BOTH))
											{
												if($A_rowres[6]=="302填寫中")
													$Color="#FFADAD";
												else if($A_rowres[6]=="前往311...")
													$Color="#FFD6A5";
												else if($A_rowres[6]=="等待面試中")
													$Color="#FDFFB6";
												else if($A_rowres[6]=="抵達五樓")
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
													<td style="background-color:<?php echo $Color?>"><?php echo $A_rowres[1]?></td>
														<td style="background-color:<?php echo $Color?>"><?php echo "A-".$A_rowres[4]."-".$A_rowres[7]."(".$A_rowres[5].")"?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $A_rowres[6]?></td>
												<?php
													if($A_rowres[6]=="抵達五樓")
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
													
													if($B_rowres = mysqli_fetch_array($B_result_status, MYSQLI_BOTH))
													{	
														if($B_rowres[6]=="302填寫中")
															$Color="#FFADAD";
														else if($B_rowres[6]=="前往311...")
															$Color="#FFD6A5";
														else if($B_rowres[6]=="等待面試中")
															$Color="#FDFFB6";
														else if($B_rowres[6]=="抵達五樓")
															$Color="#CAFFBF";
														else if($B_rowres[6]=="開始面試")
															$Color="#9BF6FF";
														else if($B_rowres[6]=="回饋填寫中")
															$Color="#A0C4FF";
														else if($B_rowres[6]=="面試完畢")
															$Color="#FFC6FF";
														else//他還沒來
															$Color="#F0EFEB";
												?>
														<td style="background-color:<?php echo $Color?>"><?php echo $B_rowres[0]?></td>
														<td style="background-color:<?php echo $Color?>"><?php echo $B_rowres[1]?></td>
														<td style="background-color:<?php echo $Color?>"><?php echo "B-".$B_rowres[4]."-".$B_rowres[7]."(".$B_rowres[5].")"?></td>
														<td style="background-color:<?php echo $Color?>"><?php echo $B_rowres[6]?></td>
														<?php
														if($B_rowres[6]=="抵達五樓")
														{
														?>
															<td style="background-color:<?php echo $Color?>"><button name="<?php echo $B_rowres[0]?>">入場面試</button></td>
														<?php 
														}
														else if($B_rowres[6]=="開始面試")
														{
														?>
															<td style="background-color:<?php echo $Color?>"><button name="<?php echo "C_".$B_rowres[0]?>" class="button special small" style="padding: 0 0.5em;">搞錯了</button></td>
														<?php 	
														}
														else
														{
														?>
															<td style="background-color:<?php echo $Color?>"> </td>
														<?php 	
														}
													}
													else
													{
												?>
														<td style="background-color:#D0D0D0"></td>
														<td style="background-color:#D0D0D0"></td>
														<td style="background-color:#D0D0D0"></td>
														<td style="background-color:#D0D0D0"></td>
														<td style="background-color:#D0D0D0"></td>
												<?php
													}
												?>
												</tr>
											<?php
											}
											while ($B_rowres = mysqli_fetch_array($B_result_status, MYSQLI_BOTH))
											{	
												if($B_rowres[6]=="302填寫中")
													$Color="#FFADAD";
												else if($B_rowres[6]=="前往311...")
													$Color="#FFD6A5";
												else if($B_rowres[6]=="等待面試中")
													$Color="#FDFFB6";
												else if($B_rowres[6]=="抵達五樓")
													$Color="#CAFFBF";
												else if($B_rowres[6]=="開始面試")
													$Color="#9BF6FF";
												else if($B_rowres[6]=="回饋填寫中")
													$Color="#A0C4FF";
												else if($B_rowres[6]=="面試完畢")
													$Color="#FFC6FF";
												else//他還沒來
													$Color="#F0EFEB";
											?>
												<tr>
													<td style="background-color:#D0D0D0"></td>
													<td style="background-color:#D0D0D0"></td>
													<td style="background-color:#D0D0D0"></td>
													<td style="background-color:#D0D0D0"></td>
													<td style="background-color:#D0D0D0"></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $B_rowres[0]?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $B_rowres[1]?></td>
														<td style="background-color:<?php echo $Color?>"><?php echo "B-".$B_rowres[4]."-".$B_rowres[7]."(".$B_rowres[5].")"?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $B_rowres[6]?></td>
												<?php
													if($B_rowres[6]=="抵達五樓")
													{
												?>
														<td style="background-color:<?php echo $Color?>"><button name="<?php echo $B_rowres[0]?>">入場面試</button></td>
												<?php 
													}
													else if($B_rowres[6]=="開始面試")
													{
												?>
														<td style="background-color:<?php echo $Color?>"><button name="<?php echo "C_".$B_rowres[0]?>" class="button special small" style="padding: 0 0.5em;">搞錯了</button></td>
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
					&copy; Untitled. Design 資工四甲10611128劉紀佑</a>
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