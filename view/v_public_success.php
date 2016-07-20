<?php include("app/views/includes/public_header.php"); ?>

<section id="services">
        <div class="container">
            <div class="row">
	            <div class="col-lg-12 text-center">
	                <h2 class="section-heading"></h2>
	            </div>
	        </div>
			<div class="row">
				<div>
			<h2><?php $this->get_data('page_title'); ?> </h2>
				</div>

			<?php	$name = $this->get_data('name', FALSE); ?>
				</div>
			<p><?php echo ucwords($name) ;?>, we appreciate your purchase. Have a good day!</p>
				</div>
		</div>
	</div>
</section>

<?php include("app/views/includes/public_footer.php"); ?>