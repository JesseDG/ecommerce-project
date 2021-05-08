

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Wishlist</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Product name</td>
							<td class="price" colspan="4">Price</td>
							<td class="remove"  ">Remove</td>
							<td class="transfer"  ">Transfer to Cart</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						
							<?php echo $data['str']; ?>
							<script>
								$(document).ready(function(){

									$(".wishlist_quantity_delete").click(function(){
										wishlistID = $(this).attr("value");
										console.log(wishlistID);
										$.ajax({
											url:"wishlistPage/deleteFromWishlist/"+wishlistID,
											success: function(result){

												$("#row"+wishlistID).hide("slow",function(){
													$(this).remove();
												});

												
											}

										});
									});
									$(".wishlist_transfer").click(function(){
										wishlistID = $(this).attr("value");
										console.log(wishlistID);
										$.ajax({
											url:"wishlistPage/transferToCart/"+wishlistID,
											success: function(result){

												$("#row"+wishlistID).hide("slow",function(){
													$(this).remove();
												});

												
											}

										});
									});
								});
							</script>
						
							
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
		
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2016 Squad Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
     <script src="./js/jquery.js"></script>
	<script src="./js/price-range.js"></script>
    <script src="./js/jquery.scrollUp.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>

	

	