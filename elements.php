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
							if($_COOKIE['Ulogin']=="管理員")
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
				<div class="inner" style="max-width:90%">
					<h2>資料顯示(考場內使用)</h2>
					<h3>請等待<font style="background:#9BF6FF">"藍格"</font>的人的到來</h3>
					<h3>面試完畢後請點選按鈕確認變成<font style="background:#A0C4FF">"靛格"</font></h3>
						<div class="12u">
							<div class="table-wrapper" style="color:black;width:100%;">
								<form method="post" style="width:100%;" action="">
									<?php
										if(isset($_POST['RefreshData']))
										{
											$SQL_DATA="SELECT * FROM `Candidate` WHERE `Class`=\"".$_POST['class']."\"and`Time`=\"".$_POST['time']."\"and`round`=\"".$_POST['round']."\" ORDER BY `Candidate`.`Time` ASC, `Candidate`.`round` ASC , `Candidate`.`Number` ASC";
											$DATA_result_status=mysqli_query($db_link,$SQL_DATA) or die("查詢失敗");
										}
									?>						
									<div class="select-wrapper">
										<select name="class"style="width:30%;float:left">
											<option value="A"<?php if($_POST['class']=="A") echo "selected"?>>A</option>
											<option value="B"<?php if($_POST['class']=="B") echo "selected"?>>B</option>
										</select>
										<select name="time"style="width:30%;float:left">
										
											<option value="1"<?php if($_POST['time']=="1") echo "selected"?>>1</option>
											<option value="2"<?php if($_POST['time']=="2") echo "selected"?>>2</option>
											<option value="3"<?php if($_POST['time']=="3") echo "selected"?>>3</option>
											<option value="4"<?php if($_POST['time']=="4") echo "selected"?>>4</option>
											<option value="5"<?php if($_POST['time']=="5") echo "selected"?>>5</option>
											<option value="6"<?php if($_POST['time']=="6") echo "selected"?>>6</option>
											<option value="7"<?php if($_POST['time']=="7") echo "selected"?>>7</option>
										</select>
										<select name="round"style="width:30%;float:left">
											<option value="1"<?php if($_POST['round']=="1") echo "selected"?>>1</option>
											<option value="2"<?php if($_POST['round']=="2") echo "selected"?>>2</option>
											<option value="3"<?php if($_POST['round']=="3") echo "selected"?>>3</option>
											<option value="4"<?php if($_POST['round']=="5") echo "selected"?>>4</option>
											<option value="5"<?php if($_POST['round']=="5") echo "selected"?>>5</option>
										</select>
										<button class="button special small" style="float:left;width:10%;padding:0 0.3em" name="RefreshData">查詢</button>
									</div>
									</form>
								<form method="post" style="width:100%;" action="elementssent.php">
									<table class="alt" >
										<thead>
											<tr style="height:20px;">
												<th style="text-align: center;width:5%;"><div style="overflow:auto;width:100%;height:100px;">准考證號</div></th>
												<th style="text-align: center;width:5%;"><div style="overflow:auto;width:100%;height:100px;">考生<br>姓名</th>
												<th style="text-align: center;width:5%;"><div style="overflow:auto;width:100%;height:100px;">梯次與場次</th>
												<th style="text-align: center;width:4%;"><div style="overflow:auto;width:100%;height:100px;">考生狀態</th>
												<th style="text-align: center;width:12%;"><div style="overflow:auto;width:100%;height:100px;">題目一</div></th>
												<th style="text-align: center;width:11%;"><div style="overflow:auto;width:100%;height:100px;">題目二-1<br>假設您現在已經取得資訊工程學位，您想利用資訊科技來改善甚麼?怎麼做?</div></th>
												<th style="text-align: center;width:11%;"><div style="overflow:auto;width:100%;height:100px;">題目二-2<br>最近令您印象深刻的資訊科技相關新聞是甚麼?為甚麼?</div></th>
												<th style="text-align: center;width:11%;"><div style="overflow:auto;width:100%;height:100px;">題目二-3<br>您認為就讀資訊工程的學生，需要具備怎麼樣的能力或特質呢?</div></th>
												<th style="text-align: center;width:11%;"><div style="overflow:auto;width:100%;height:100px;">題目三</div></th>
												<th style="text-align: center;width:7%;"><div style="overflow:auto;width:100%;height:100px;">分數</div></th>
												<th style="text-align: center;width:11%;"><div style="overflow:auto;width:100%;height:100px;">該生註記</div></th>
											</tr>
										</thead>
										<tbody>
										<?php
											while ($DATA_rowres = mysqli_fetch_array($DATA_result_status, MYSQLI_BOTH))
											{
												if($DATA_rowres[6]=="302填寫中")
													$Color="#FFADAD";
												else if($DATA_rowres[6]=="前往311...")
													$Color="#FFD6A5";
												else if($DATA_rowres[6]=="等待面試中")
													$Color="#FDFFB6";
												else if($DATA_rowres[6]=="抵達五樓")
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
													<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[0]?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[1]?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[3]."-".$DATA_rowres[4]."-".$DATA_rowres[7]."(".$DATA_rowres[5].")"?></td>
													<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[6]?></td>
												<?php
													if($DATA_rowres[8]=="1")
													{
												?>
														<td style="background-color:<?php echo $Color?>"><?php echo "軟體設計與應用<br>".$DATA_rowres[9]?></td>
												<?php
													}
													else if($DATA_rowres[8]=="2")
													{
												?>
														<td style="background-color:<?php echo $Color?>"><?php echo "嵌入式系統與應用<br>".$DATA_rowres[9]?></td>
												<?php
													}
													else if($DATA_rowres[8]=="3")
													{
												?>	
														<td style="background-color:<?php echo $Color?>"><?php echo "網路通訊與應用<br>".$DATA_rowres[9]?></td><?php
													}
													else
													{
														?>
															<td style="background-color:<?php echo $Color?>"></td>
													
													<?php
													}
													if($DATA_rowres[7]%3==0)
													{
													?>
														<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[10]?></td>
															<td style="background-color:<?php echo $Color?>"></td>
															<td style="background-color:<?php echo $Color?>"></td>
													<?php
														}
														else if($DATA_rowres[7]%3==1)
														{
													?>
															<td style="background-color:<?php echo $Color?>"></td>
															<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[10]?></td>
															<td style="background-color:<?php echo $Color?>"></td>
													<?php
														}
														else if($DATA_rowres[7]%3==2)
														{
													?>
															<td style="background-color:<?php echo $Color?>"></td>
															<td style="background-color:<?php echo $Color?>"></td>
															<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[10]?></td>
													<?php
														}
													?>
													<td style="background-color:<?php echo $Color?>"><?php echo $DATA_rowres[11]?></td>
													<td style="background-color:<?php echo $Color?>"><textarea name='<?php echo $DATA_rowres[0].'_score'?>'   placeholder='分數' rows='1' style=' resize: none;'><?php echo $DATA_rowres[12]?></textarea></td>
													<td style="background-color:<?php echo $Color?>"><textarea name='<?php echo $DATA_rowres[0].'_stunotice'?>'  placeholder='考生註記' rows='4' style=' resize: none;'><?php echo $DATA_rowres[13]?></textarea></td>
												</tr>
											<?php
											}?>
										</tbody>
									</table>
									<div style="width:100%;">
										<button class="button special small" style="float:center;width:10%;padding:0 0.3em" name="NewData">本梯次面試結束</button>
										<input type="hidden" value='<?php echo $_POST['class']?>' name="class">
										<input type="hidden" value='<?php echo $_POST['time']?>' name="time">
										<input type="hidden" value='<?php echo $_POST['round']?>' name="round">
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