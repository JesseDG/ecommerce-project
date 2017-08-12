	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php
								echo $data['str3'];
							?>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php
										echo $data['str2']; 
									?>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						
						
						
						
					</div>
					
				</div>
				
				<?php echo $data['str']; ?>

				<script>
					$(document).ready(function(){

						$(".addToCart").click(function(){
							productID = $(this).attr("value");
							console.log(productID);
							$.ajax({
								url:"cart/addToCart/"+productID,
								success: function(result){}

							});
						});
						$(".addToWishlist").click(function(){
							productID = $(this).attr("value");
							console.log(productID);
							$.ajax({
								url:"wishlistPage/addToWishlist/"+productID,
								success: function(result){console.log('success');}

							});
						});
					});
				</script>
					
					
					
					
					
				</div>
			</div>

		</div>

	</section>

	
	<footer id="footer"><!--Footer-->	
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 Squad Inc. All rights reserved.</p>
					<p class="pull-right">Created by <span><a target="_blank">D&W </a> </span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="./js/jquery.js"></script>
	<script src="./js/price-range.js"></script>
    <script src="./js/jquery.scrollUp.min.js"></script>
	
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>