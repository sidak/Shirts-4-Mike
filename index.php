<?php
$pageTitle="Unique T-shirts designed by a frog";
include('inc/header.php'); 
	// don't use '/' before inc
	// '/' means the real server root directory, not the web document root.
	// If you need the relocatability use:
	// include("{$_SERVER['DOCUMENT_ROOT']}/inc/header.php");	
?>

		<div class="section banner">

			<div class="wrapper">

				<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
				<div class="button">
					<a href="shirts.php">
						<h2>Hey, I&rsquo;m Mike!</h2>
						<p>Check Out My Shirts</p>
					</a>
				</div>
			</div>

		</div>

		<div class="section shirts latest">

			<div class="wrapper">

				<h2>Mike&rsquo;s Latest Shirts</h2>
				<?php include('inc/products.php'); ?>
				<ul class="products">
					<?php 
						$total_products=count($products);
						$posn=0;
						$list_view_html="";
						foreach($products as $product_id => $product) { 
							$posn++;
							if($total_products-$posn<4)
								$list_view_html=get_list_view_html($product_id, $product).$list_view_html;
								// concatenate in the opp direcn
						}
						echo $list_view_html;
					?> 							
				</ul>

			</div>

		</div>

<?php include("inc/footer.php"); ?>

