<!DOCTYPE html>
<?php include "view/v_public_blog.php"; ?>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<!-- Document Title
	============================================= -->
	<title>Blog Post | Scott Jose Fitness | London</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="sticky-style-2">

			<div class="container clearfix">

				<!-- Logo
				============================================= -->

				<div id="logo" class=" col-md-12 divcenter">
					<a href="index.php" class="standard-logo" data-dark-logo="images/logo.jpg"><img class="divcenter" src="images/logo.jpg" alt="Canvas Logo"></a>
					<a href="index.php" class="retina-logo" data-dark-logo="images/logo.jpg"><img class="divcenter" src="images/logo.jpg" alt="Canvas Logo"></a>
				</div><!-- #logo end -->


			</div>

			<div id="header-wrap">

				<!-- Primary Navigation
				============================================= -->
				<nav id="primary-menu" class="style-2 center">

					<div class="container clearfix">

						<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

						<ul>
							<li><a href="index.php"><div>Home</div></a></li>
							<li><a href="about.php"><div>About</div></a></li>
							<li><a href="personaltraining.php"><div>Personal Training</div></a></li>
							<li><a href="online.php"><div>Online Training</div></a></li>
							<li><a href="results.php"><div>Results</div></a></li>
							<li><a href="retreats.php"><div>Retreats</div></a></li>
							<li class="current"><a href="blog.php"><div>Blog</div></a></li>
							<li><a href="contact.php"><div>Contact</div></a></li>
						</ul>

					</div>

				</nav><!-- #primary-menu end -->

			</div>

		</header><!-- #header end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="single-post topmargin bottommargin">

						    <?php 
          					$posts = display_blog_post(); 
          					echo $posts; 
          					?>

					</div>
				</div>
			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

						
			<!-- Copyrights
			============================================= -->
			<div id="copyrights">

				<div class="container clearfix">

					<div class="col_half">
						Copyrights &copy; 2016 All Rights Reserved by <a href="http://www.amytisweb.com">Amytis Web Development</a><br>
						<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
					</div>

					<div class="col_half col_last tright">

						<div class="clear"></div>

						<i class="icon-envelope2"></i><a href="mailto:info@scottjosefitness.com"> info@scottjosefitness.com </a><span class="middot">&middot;</span> <i class="icon-skype2"></i><a href="skype:info@scottjosefitness.com"> Scott Jose Fitness </a>
					</div>

				</div>

			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="js/functions.js"></script>

</body>
</html>