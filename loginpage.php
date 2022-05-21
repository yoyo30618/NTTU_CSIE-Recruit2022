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
		header("Content-Type:text/html;charset=utf-8");
		session_start();

		if(isset($_COOKIE['Uname']))
		{
			//已經登入
			echo"<script language=\"JavaScript\">alert('您已經登入');location.href=\"index.php\";</script>";
		}
		else
		{
		}
	?>
	<!-- Header -->
	<header>
		<?php
	if (isset($_COOKIE['GroupID']))
	{
		//已經登入
		if ($_COOKIE['GroupID']==-1)
		{
			echo "<header id='header' style='background-color:white'>";
		}
		else if ($_COOKIE['GroupID']%2==1)
		{
			echo "<header id='header' style='background-color:#BFFFFF'>";
		}
		else if ($_COOKIE['GroupID']%2==0)
		{
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
			if (isset($_COOKIE['Uname'])) {
				//已經登入
				echo "<a href='logout.php' class='button alt'>Log Out</a>";
			} else {
				echo "<a href='loginpage.php' class='button alt'>Log in</a>";
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
						if(isset($_COOKIE['Ulogin'])&&($_COOKIE['Ulogin']=='管理員'||$_COOKIE['Ulogin']=='工作人員'))
						{
					?>
							<li><a href="checkin.php">報到狀態(報到處使用)</a></li>
							<li><a href="status_302.php">填答狀態(C302使用)</a></li>
							<li><a href="status_311.php">考生狀態(C311使用)</a></li>
							<li><a href="status_5F.php">考生狀態(420使用)</a></li>
							<li><a href="status_420.php">考生狀態(420使用)</a></li>
							<li><a href="status_403.php">考生狀態(403使用)</a></li>
					<?php
						}
					?>
					<?php
						if(isset($_COOKIE['Ulogin'])&&$_COOKIE['Ulogin']=='管理員')
						{
					?>
							<li><a href="interview.php">資料顯示((筆試考官使用))</a></li>
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
					<h1>登入</h1>
					<p>帳號為准考證號/密碼為身分證字號</p>
				</header>
		<!-- Elements -->
				<div class="row 200%">
					<div class="12u">
						<!-- Form -->
						<form method="post" action="logincheck.php">
							<div class="row uniform">
								<div class="6u 12u$(xsmall)">
									<input type="text" name="Uname" id="Uname" value="" placeholder="帳號：准考證號" /><br>
									<input type="password" name="Upwd" id="Upwd" value="" placeholder="密碼：身分證字號" />
								</div>
						<!-- Break -->
								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="登入" name="trylogin"/></li>
										<li><input type="reset" value="清除" class="alt" /></li>
									</ul>
								</div>
							</div>
						</form>
						<hr />
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
