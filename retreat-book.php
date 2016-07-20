<!DOCTYPE html>

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
	<title>Retreats | Scott Jose Fitness | London</title>

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
							<li class="current"><a href="retreats.php"><div>Retreats</div></a></li>
							<li><a href="blog.php"><div>Blog</div></a></li>
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

					<div class="row clearfix topmargin bottommargin">
						<div class="col-md-6">
							<?php
								include 'model/m_events.php';

								$location = $_GET['location'];
								    $Retreats = new Posts();
								    $retreats = $Retreats->get_retreats($location); 
							    ?>
							<h3>Billing Address</h3>


							<form id="billing-form" name="billing-form" class="nobottommargin" action="checkout.php" method="post">


								<div class="col_half col_last">
									<label for="billing-form-lname">Name:</label>
									<input type="text" id="name" name="name" value="" class="sm-form-control" />
								</div>

								<div class="clear"></div>

								<div class="col_full">
									<label for="billing-form-address">Address:</label>
									<input type="text" id="address" name="address" value="" class="sm-form-control" />
								</div>

								<div class="col_full">
									<input type="text" id="address2" name="address2" value="" class="sm-form-control" />
								</div>

								<div class="col_half">
									<label for="billing-form-city">City / Town</label>
									<input type="text" id="city" name="city" value="" class="sm-form-control" />
								</div>

								<div class="col_half col_last">
									<label for="billing-form-lname">Post Code:</label>
									<input type="text" id="postcode" name="postcode" value="" class="sm-form-control" />
								</div>

								<div class="col_half ">
									<label for="billing-form-email">Email Address:</label>
									<input type="email" id="email" name="email" value="" class="sm-form-control" />
								</div>

								<div class="col_half col_last">
									<label for="billing-form-phone">Phone:</label>
									<input type="text" id="phone" name="phone" value="" class="sm-form-control" />
								</div>

								<input type="hidden" id="location_id" name="location_id" value="<?php echo $retreats[0]['location']; ?>" class="sm-form-control" />
								<input type="hidden" id="deposit" name="deposit" value="<?php echo $retreats[0]['deposit']; ?>" class="sm-form-control" />
								<input type="hidden" id="item" name="item" value="<?php echo $retreats[0]['location']; ?> Deposit" class="sm-form-control" />

						</div>

						<div class="col-md-6">
							<div class="table-responsive">
								<h3>Booking Info</h3>
	
								<table class="table cart">
									<tbody>
										<tr class="cart_item">
											<td class="notopborder cart-product-name">
												<strong>Location</strong>
											</td>

											<td class="notopborder cart-product-name">
												<span class="amount"><?php echo $retreats[0]['location']; ?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Hotel</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?php echo $retreats[0]['hotel']; ?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Date</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?php echo $retreats[0]['date']; ?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Total Price</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?php echo '&pound; '.$retreats[0]['fullprice']; ?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Deposit</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount"><?php echo '&pound; '.$retreats[0]['deposit']; ?></span>
											</td>
										</tr>
										<tr class="cart_item">
											<td class="cart-product-name">
												<strong>Total to Pay today</strong>
											</td>

											<td class="cart-product-name">
												<span class="amount scottcolortext lead"><strong><?php echo '&pound; '.number_format($retreats[0]['deposit'],2); ?></strong></span>
											</td>
										</tr>
									</tbody>
								</table>

							</div>
							<div class="feature-box fbox-plain fbox-dark fbox-small">
									<div class="fbox-icon">
										<i class="icon-credit-cards"></i>
									</div>
									<h3>Payment Options</h3>
									<p class="notopmargin">Payment services provided by Paypal</p>
									<p class="notopmargin">We accept Visa, MasterCard and American Express.</p>
								</div>
							<input type="submit" class="button button-3d fright" value="Book Space">
						</div>
					</div>
				</div>
			</div>
			</form>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">

			<div class="container">

			

			</div>

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