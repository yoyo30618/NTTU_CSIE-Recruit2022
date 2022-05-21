<!DOCTYPE HTML>

<html>
	<head>

		<title>東大資工面試報到</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>


		<!-- Header -->
		<header>
		<?php
		if(isset($_COOKIE['Round']))
		{
		//已經登入
			if($_COOKIE['Round']%2==1)
			{
				echo "<header id='header' style='background-color:#BFFFFF'>";
			}
			else if ($_COOKIE['Round']%2==0) {
				echo "<header id='header' style='background-color:#BFFFBF'>";
			}
		}
		else
			{
				echo "<header id='header' style='background-color:white'>";
			}
		?>
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
							echo "<a href='logout.php' class='button alt'>Log Out</a>";
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
						if($_COOKIE['Ulogin']=='口試')
						{
					?>
							<li><a href="interview.php">面試顯示(面試考官使用)</a></li>
					<?php
						}
					?>

					<?php
						if($_COOKIE['Ulogin']=='書審')
						{
					?>
							<li><a href="elements.php">資料顯示(筆試考官使用)</a></li>
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

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="inner">
					<header class="align-center">
						<h1>111學年度個人申請面試問卷</h1>
					</header>
					<!-- Content -->
						<h3 id="content">歡迎您來參加本系個人申請面試，進入面試試場前，請您先填寫以下問卷。<br>此問卷是為了解您的一些基本訊息，請您審慎填寫，確認無誤後再送出。</h3>
						<p><b><font style="color:red;">本問卷僅能填寫一次，請詳加確認後再按下確認提交！</font></b></p>
					<hr class="major" />
					<!-- Elements -->
						<div class="row 200%">
							<div class="12u">
								<!-- Form -->
									<?php
										$sql_ANS="SELECT * FROM `candidate` WHERE ExamID=\"".$_COOKIE['Uname']."\"";
										require("conn_mysql.php");
										$result_ANS=mysqli_query($db_link,$sql_ANS) or die("查詢失敗");
										while ($ANS = mysqli_fetch_array($result_ANS, MYSQLI_BOTH))
										{
											$Ac1=$ANS[8];
											$A1=$ANS[9];
											$A2=$ANS[10];
											$A3=$ANS[11];
											$A4=$ANS[12];
											$A5=$ANS[13];
											$A6=$ANS[41];
											break;
										}

									?>

									<form method="post" action="surveySet.php">
										<div class="row uniform">
											<h3>1.東大資工的課程地圖中，系上課程可以分為「軟體設計與應用」、「嵌入式系統與應用」、「網路通訊與應用」三大模組，請問您對哪一個模組最有興趣?為甚麼?</h3>
											<!-- Break -->
											<div class="4u 12u$(small)">
											<?php

												if($Ac1=="1"||$Ac1=="0")
													echo "<input type='radio' id='priority-low' name='Qc1' value='1' checked>";
												else
													echo "<input type='radio' id='priority-low' name='Qc1' value='1'>";
												?>
												<label for="priority-low">軟體設計與應用</label>
											</div>
											<div class="4u 12u$(small)">
												<?php
												if($Ac1=="2")
													echo "<input type='radio' id='priority-normal' name='Qc1' value='2' checked>";
												else
													echo "<input type='radio' id='priority-normal' name='Qc1'  value='2'>";
												?>
												<label for="priority-normal">嵌入式系統與應用</label>
											</div>
											<div class="4u$ 12u$(small)">
												<?php
												if($Ac1=="3")
													echo "<input type='radio' id='priority-high' name='Qc1' value='3' checked>";
												else
													echo "<input type='radio' id='priority-high' name='Qc1' value='3'>";
												?>
												<label for="priority-high">網路通訊與應用</label>
											</div>
											<div class="12u$">
											<?php
												if($Ac1==0)
													echo "<textarea name='Q1' id='Q1'  placeholder='請在此回答第一題' rows='4' style=' resize: none;'>".$A1."</textarea>";
												else
													echo $A1;
											?>
											</div>

											<h3>2.您認為就讀資訊工程的學生，需要具備甚麼樣的能力或特質嗎？</h3>

											<div class="12u$">
											<?php
												if($Ac1==0)
													echo "<textarea name='Q2' id='Q2'  placeholder='請在此回答第二題' rows='4' style=' resize: none;'>".$A2."</textarea>";
												else
													echo $A2;
											?>
											</div>

											<h3>3.假設您現在已經取得資訊工程學位，您想利用資訊科技來改善甚麼？怎麼做？</h3>
											<!-- Break -->
											<div class="12u$">
											<?php
												if($Ac1==0)
													echo "<textarea name='Q3' id='Q3'  placeholder='請在此回答第三題' rows='4' style=' resize: none;'>".$A3."</textarea>";
												else
													echo $A3;
											?>
											</div>

											<h3>4. 最近令您印象深刻的資訊科技相關新聞是甚麼？為什麼？</h3>
											<!-- Break -->
											<div class="12u$">
											<?php
												if($Ac1==0)
													echo "<textarea name='Q4' id='Q4'  placeholder='請在此回答第四題' rows='4' style=' resize: none;'>".$A4."</textarea>";
												else
													echo $A4;
											?>
											</div>



											<h3>5.請用一句話形容自己。</h3>
											<!-- Break -->
											<div class="12u$">
											<?php
												if($Ac1==0)
													echo "<textarea name='Q5' id='Q5'  placeholder='請在此回答第五題' rows='4' style=' resize: none;'>".$A5."</textarea>";
												else
													echo $A5;
											?>
											</div>

											<h3>6.除了報考東大資工外，您還有報考哪學校、科系?</h3>
											<!-- Break -->
											<div class="12u$">
											<?php
												if($Ac1==0)
													echo "<textarea name='Q6' id='Q6'  placeholder='請在此回答第六題' rows='4' style=' resize: none;'>".$A6."</textarea>";
												else
													echo $A6;
											?>
											<!-- Break -->
											<?php
												if($Ac1=="0"&&$_COOKIE['Ulogin']=="考生")
												{
											?>
													<div class="12u$">
														<ul class="actions">
															<li><input type="submit" value="確認提交" name="SetAns" id="submit-btn"/></li>
														</ul>
													</div>
											<?php
												}
												else if($_COOKIE['Ulogin']=="考生")
												{
											?>
													<div class="12u$">
														<ul class="actions">
															<li>已提交答案，祝福面試順利</li>
														</ul>
													</div>
											<?php
												}
											?>
										</div>
									</form>
							</div>
						</div>

				</div>
			</section>

			<?php
			if ($Ac1=="0"&&$_COOKIE['Ulogin']=="考生") {
			?>
			<div class="containerr">
				<h2> 繳交倒數 </h2>
				<h4 id="count">---</h4>
			</div>


			<?php
				}
			else  {
			?>
			<div class="containerr">
				<h2> 已完成作答 </h2>
			</div>
			<?php
				}
			?>

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
					&copy; Untitled. Design 資工四甲10611128劉紀佑<br/>
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
			<script src="assets/js/timecounter.js"></script>

	</body>
</html>
