<!DOCTYPE html>
<?php include "view/v_public_blogs.php"; ?>
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
	<title>Blog | Scott Jose Fitness | London</title>

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
							<li><a href="#"><div>Results</div></a></li>
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

				<div class="container clearfix" style="margin-top:100px;">

					<!-- Post Content
					============================================= -->
					<div class="postcontent nobottommargin clearfix">

						<!-- Posts
						============================================= -->
						<div id="posts">

						<!--<div class="alert alert-danger nobottommargin">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <i class="icon-remove-sign"></i><strong>Oh snap!</strong> Change a few things up and try submitting again.
						</div>-->

          					<?php 

          					$search = @$_POST['search'];
          					$keywords = @$_POST['keywords'];

          					if ($search == '1')
          					{
          						echo    '<div class="alert alert-success">';
						  		echo	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						  		echo	'<i class="icon-search3"></i>You searched for <a href="#" class="alert-link">'.$keywords.'</a>.';
								echo	'</div>';

          						$posts = display_posts('','',$keywords); 
          						echo $posts; 
          					}
          					else
          					{
								$posts = display_posts(); 
          						echo $posts; 
          					}

          					
          					?>
					</div><!-- .postcontent end -->

					<!-- Sidebar
					============================================= -->
					<div class="sidebar nobottommargin col_last clearfix">
						<div class="sidebar-widgets-wrap">

							<div class="widget subscribe-widget clearfix">
								<h4 class="highlight-me">Search</h4>
								<form action="blog.php" method="post" class="notopmargin nobottommargin" >
									<div class="input-group divcenter">
										<input type="text" class="form-control" placeholder="" required="" name="keywords" id="keywords">
										
										<span class="input-group-btn">
											<input type="submit" class="btn btn-success scottcolor"><i class="icon-search3"></i>
										</span>
										<input type="hidden" class="form-control" placeholder="" required="" name="search" id="search" value="1">
									</div>
								</form>
							</div>

							<div id="subscriber" class="widget subscribe-widget clearfix">
								<h4 class="highlight-me">Subscribe For Latest Posts</h4>
								<h5>Subscribe to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
								<form action="examples.php" method="POST" role="form" class="notopmargin nobottommargin" novalidate="novalidate">
									<div class="col_full input-group divcenter">
										<input type="text" class="form-control" placeholder="First Name" required="" aria-required="true" name="first">
									</div>
									<br /><br />
										<div class="col_full col_last input-group divcenter">
										<input type="text" class="form-control" placeholder="Last Name" required="" aria-required="true" name="last">
										</div>
										<br />
										<div class="input-group divcenter">
										<input type="text" class="form-control" placeholder="Enter your Email" required="" aria-required="true" name="email"> 
										<span class="input-group-btn">
											<button class="btn btn-success scottcolor" type="submit"><i class="icon-email2"></i></button>
										</span>
									</div>
								</form>
								<?php 
								$start = @$_SESSION['message'];
								if (!empty($start))
								{
									echo '
								
							<div class="alert alert-success">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						  <strong>Well done!</strong>'.$start.'</div>'; } ?>
	
						</div>

					</div><!-- .sidebar end -->

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

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="js/functions.js"></script>



</body>
</html>