

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image" style="">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td class="delete">Delete</td>
							<td class="transfer" colspan="4">Transfer to wishlist</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<div class="cartRows">
						<?php echo $data['str']; ?>


						<script>
							$(document).ready(function(){

								$(".btn").click(function(){
									orderID = $(this).attr("value");
									if(orderID != null)
									{
										console.log(orderID);
									}
									$.ajax({
										url:"cart/deleteFromCart/"+orderID,
										success: function(result){

											$("#row"+orderID).hide("slow",function(){
												$(this).remove();
											});

											$("#total").html(result + '$');
										}

									});
								});


								$(".down").click(function(){
									orderID = $(this).attr("value");
									str = '.qty' + orderID;
									inputObject = $(str);
									inputQty = inputObject.val();
									priceObject = $('.price' + orderID);
									newQty = 0;
									console.log(inputQty);
									if(inputQty > 1) 
									{
										newQty = parseInt(inputQty)-1;
										inputObject.val(newQty);
									}
									inputObject.val(newQty);
									$('.total' + orderID).val(newQty * parseInt(priceObject.val()));
									
									console.log(orderID); //sooo?
									$.ajax({
										url:"cart/decreaseQuantity/"+orderID,
										success: function(result){
											$("#total").html(result + '$');
										}

									});
								});

								$(".up").click(function(){
									orderID = $(this).attr("value");
									//str = '.qty' + orderID;
									

									inputObject = $('.qty' + orderID);
									inputQty = inputObject.val();

									//console.log( (parseInt(inputQty) <= parseInt($("#maxQuantity").attr("value"))+1));

									if(parseInt(inputQty) < parseInt($("#maxQuantity").attr("value")))
									{
										priceObject = $('.price' + orderID);
										price = priceObject.val();


										newQty = parseInt(inputQty)+1;
										inputObject.val(newQty);


										totalObject = $('.total' + orderID);
										newTotal = newQty * parseInt(price);
										//totalObject.val(newTotal);
										totalObject.val(newTotal);

										$.ajax({
											url:"cart/increaseQuantity/"+orderID,
											success: function(result){
												$("#total").html(result + '$');
											}

										});
									}

								});
								$(".wishlist_transfer").click(function(){
										orderID = $(this).attr("value");
										console.log(orderID);
										$.ajax({
											url:"cart/transferToWishlist/"+orderID,
											success: function(result){

												$("#row"+orderID).hide("slow",function(){
													$(this).remove();
												});
												$("#total").html(result + '$');

												
											}

										});
									});
								
								


							});


					</script>

					
						</div>
					</tbody>

				</table>

			</div>
		</div>

	</section> <!--/#cart_items-->
	
	

	<section id="do_action">
		<div class="container">
			<div class="row">

				<div class="col-sm-6">
				<div class="total_area">

						
							<ul>
								<li>Total <span id="total"> <?php echo (isset($data['checkoutTotal'])?$data['checkoutTotal']:'0'); ?> </span></li>
							</ul>
								<button  href="" class="checkout" style="float: right;margin-top:10%;" value="<?php echo $data['sale_id'];?>">Check Out</button>
								<script>
								$(document).ready(function(){
									$(".checkout").click(function(){
										sale_id = $(this).attr("value");
										
										$('body').find("#prompt").show(500);
											
									});
									$("#yes").click(function()
										{	

											$.ajax({

											url:"cart/checkOut/"+sale_id,
											success: function(result){
										

												element = document.getElementsByClassName("rowToDelete");
												count = 1;
												console.log(element);
												delayTime = 1000;
												for(i = 0; i < element.length; i++)
												{
													
													$(element[i]).delay(delayTime).hide("slow",function(){
														$(this).remove();
													});

													delayTime += 1000;

												}
													

												$('body').find("#prompt").hide("slow",function(){
													$(this).remove();
												});
												}
											});

										});		
									});

								
							</script>						
					</div>
				</div>
			</div>
		</div>
		<table>
			<tr>
				<div id="prompt" style="display:none;">
					<h1 style="text-align:center;color:red;">Would you like to proceed with the transaction?</h1>
					<div style="text-align:center;">
						<button class="btn btn-default" id="yes" style="text-align:center;">Yes!</button><button class="btn btn-default" id="No" style="text-align:center;">Non!</button>
					</div>
					
				</div>
			</tr>
			<tr>
				<footer id="footer"><!--Footer-->		
					<div class="footer-bottom">
						<div class="container">
							<div class="row">
								<p class="pull-left">Copyright © 2016 Squad Inc. All rights reserved.</p>
							</div>
						</div>
					</div>	
				</footer><!--/Footer-->
			</tr>
		</table>
		</section>
	

			
		

	
	


    <script src="./js/jquery.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery.scrollUp.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>

</body>
</html>