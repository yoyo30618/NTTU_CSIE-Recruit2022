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
					
						if(isset($_COOKIE['Uname']))
						{	header("Content-Type:text/html;charset=utf-8");
						session_start();
						$username = $_SESSION['Uname'];
							//已經登入
							echo "<a href='logout.php' class='button alt'>Log Out</a>";
						}
						else
						{
							echo "<a href='loginpage.php' class='button alt'>Log in</a>";
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
					if ($_COOKIE['Ulogin']=='class0') {
					?>
					<li><a href="checkin.php">報到狀態(報到處使用)</a></li>
					<?php
				}
					?>


					<?php
					if ($_COOKIE['Ulogin']=='class1') {
					?>
					<li><a href="status_302.php">填答狀態(C302使用)</a></li>
					<?php
				}
					?>

					<?php
					if ($_COOKIE['Ulogin']=='class2') {
					?>
				<!--	<li><a href="status_311.php">考生狀態(C311使用)</a></li> -->
					<?php
				}
					?>

					<?php
					if ($_COOKIE['Ulogin']=='class5') {
					?>
					<li><a href="status_403.php">考生狀態(403使用)</a></li>
					<?php
				}
					?>


					<?php
					if ($_COOKIE['Ulogin']=='class3') {
					?>
					<li><a href="status_402.php">考生狀態(402使用)</a></li>
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


					<?php
						if($_COOKIE['Ulogin']=='口試')
						{
					?>
							<li><a href="interview.php">面試分數(面試考官使用)</a></li>

					<?php
						}
					?>

					<?php
						if($_COOKIE['Ulogin']=='書審'||$_COOKIE['Ulogin']=='口試')
						{
					?>
							<li><a href="elements.php">資料顯示(筆試考官使用)</a></li>
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


		<!-- Banner -->
			<section id="banner">
				<div class="content">

				<div style="margin-right: 45%;color:red;font-size:30px;">
				<?php
					if(isset($_SESSION['Uname']))
						echo $_SESSION['Uname'];
				?>
				</div>

				<h1>

				<?php
					if(isset($_SESSION['wname']))
						echo $_SESSION['wname'];
				?>
					國立臺東大學資訊工程學系歡迎您</h1>

					<p><span style="background-color:#F0F0F0"><b><font style="color:#B766AD;">&nbsp;&nbsp;請依指示登入系統後作答，預祝面試順利&nbsp;&nbsp;</font></b></span></p>
					<ul class="actions">
						<li><a href="survey.php" class="button scrolly">Get Started</a></li>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="wrapper">
				<div class="inner flex flex-3">
					<div class="flex-item left">
						<div>
							<h3>面試流程1</h3>
							<p>請先在電梯口前報到，並至302填寫問卷<br /></p>
						</div>
						<div>
							<h3>面試流程2</h3>
							<p>302填寫完後至420等待面試</p>
						</div>
					</div>
					<div class="flex-item image fit round">
						<img src="images/pic01.jpg" alt="" />
					</div>
					<div class="flex-item right">
						<div>
							<h3>面試流程3</h3>
							<p>到420開始面試，結束後至403填寫回饋</p>
						</div>
						<div>
							<h3>NTTU-CSIE</h3>
							<p>東大資工-正確的選擇</p>
						</div>
					</div>
				</div>
			</section>

		<!-- Two -->
			<section id="two" class="wrapper style1 special">
				<div class="inner">
					<h2>重點項目提醒</h2>
					<figure>
					    面試別緊張<br />
					    5/30 放榜<br />
					    6/9-10 記得登記志願序<br />
					    6/15 期待能到你想到的學系<br />
					    <!--東晨米糕好吃喔<br><br><br>
					    <footer>
					        <cite class="author">東晨米糕</cite>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.365456022907!2d121.13197441535091!3d22.751814932101475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346fb941006f9b69%3A0xdc742cc3a907d555!2z5p2x5pmo57Gz57OV!5e0!3m2!1szh-TW!2stw!4v1616739105763!5m2!1szh-TW!2stw" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
					    </footer>
						-->
					</figure>
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
