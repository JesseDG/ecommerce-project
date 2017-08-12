

	<br>
<div class="row" style="margin-bottom: 3%;">
<div class="col-sm-10 col-xs-offset-1">
	<div class="col-xs-8 col-xs-offset-2">
		<div class="input-group">
			<input type="hidden" name="search_param" value="all" id="search_param">
			<input type="text" class="form-control" name="x" id="typing" placeholder="Search term...">
			<span class="input-group-btn" >
					 <button class="btn btn-default" type="button" id="sendQuery" ><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</div>
		<script>

			doneTyping = 2000;
			typingTimer = '';

			// click function on the search button
			$("#sendQuery").click(function(){
				$product = $("#typing").val();
				$.post
				(
					'search/SearchProduct',
					{
						productSent: $product,
					},
					function (data) {
						$(".features_items").html(data);

					}
				)
				//send($category,$product);
			});

			//keyup function when enter is pressed
			$("#typing").on('keyup',function (e) {

				if( e.keyCode == 13){
					$product = $("#typing").val();
					$.post
					(
						'search/SearchProduct',
						{
							productSent: $product,
						},
						function (data) {
							$(".paginationDisplay").remove();
							$(".features_items").html(data);

						}
						)
					}
				});


				//if typing disappear the items in the div features_items
				$("#typing").on('keydown',function () {
					$(".features_items").children().css("visibility","hidden");
					clearTimeout(typingTimer);
				});

				//if done typing redisplay the elements if no search
				$("#typing").on('keyup',function (e) {

					if( e.keyCode != 13){

						//$category = $("#search_param").val();
						//$product = $("#typing").val();								
						clearTimeout(typingTimer);
						typingTimer = setTimeout(displayContent,doneTyping);
					}
				});

				//function display the elements
				function displayContent() {
					$(".features_items").children().css("visibility","visible")
				}

				function clickCart(e) {
					console.log(e);
					if (!logged_in) {

						$("#dialog").attr("title", "Warning");
						$("#dialog p").html("Please either login or register (it will take a few minutes!)");
						$("#dialog").css("display", "block");
						$(function () {
							$("#dialog").dialog({
								buttons: {
									"OK": function () {
										window.location.replace("login");
									}
								}
							});
						});

					}

					else {
						$("#dialog").attr("title", "Success");
						$("#dialog p").html("Item succesfully added to cart");
						$("#dialog").css("display", "block");
						$(function () {
							$("#dialog").dialog({
								draggable: false,
								resizable: false,
								show: {
									effect: 'fade',
									duration: 2000
								},
								hide: {
									effect: 'fade',
									duration: 2000
								},
								open: function(){
									$(this).dialog('close');
								},
								close: function(){
									$(this).dialog('destroy');
								}
							});
						});
					}
				}

			function clickWishlist(e) {
				console.log(e);
				if (!logged_in) {

					$("#dialog").attr("title", "Warning");
					$("#dialog p").html("Please either login or register (it will take a few minutes!)");
					$("#dialog").css("display", "block");
					$(function () {
						$("#dialog").dialog({
							buttons: {
								"OK": function () {
									window.location.replace("login");
								}
							}
						});
					});

				}

				else {
					$("#dialog").attr("title", "Success");
					$("#dialog p").html("Item succesfully added to wishlist");
					$("#dialog").css("display", "block");
					$(function () {
						$("#dialog").dialog({
							draggable: false,
							resizable: false,
							show: {
								effect: 'fade',
								duration: 2000
							},
							hide: {
								effect: 'fade',
								duration: 2000
							},
							open: function(){
								$(this).dialog('close');
							},
							close: function(){
								$(this).dialog('destroy');
							}
						});
					});
				}
			}


		</script>
		</div>
	</div>
</div>
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
				 
					
				
					
					
				</div>

			</div>
			<script>
					$(document).ready(function(){

						$(".addToCart").click(function(){
							productID = $(this).attr("value");
							$.ajax({
								url:"cart/addToCart/"+productID,
								success: function(result){}

							});
						});

					//});

					//$(document).ready(function(){

						$(".addToWishlist").click(function(){
							productID = $(this).attr("value");
							console.log(productID);
							$.ajax({
								url:"wishlistPage/addToWishlist/"+productID,
								success: function(result){console.log('success');}

							});
						});
						$(".displayDetails").click(function(){

							productID = $(this).attr("value");
							console.log(productID);
							
							window.location = "../productDetails/" + productID;
								

							
						});
						$('.pagination').on('click', function(){
						   var target = $(this).attr("value");
						   $.ajax({
						   		success: function(result){
						   			$(".paginationDisplay").hide();
						   			$("#page"+target).show();
						   		}
								

							});
						   
						  
						});

					});
				</script>
		
	</section>
	<footer id="footer"><!--Footer-->		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2016 Squad Inc. All rights reserved.</p>
				</div>
			</div>
		</div>	
	</footer><!--/Footer-->


	<div id="dialog" title="Basic dialog" style="display: block">
		<p></p>
	</div>
    
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.scrollUp.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>
	
