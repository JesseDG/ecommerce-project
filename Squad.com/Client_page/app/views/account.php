						

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12" >
					<div class="signup-form"><!--Account-->
						<h2 style="position:relative;top: 50%; left: 44%;">Account settings</h2>
						<form action="./account/changeInfo" method="POST">

							<div class="col-sm-7">
								<input type="email" placeholder="Email Address" name="email" value="<?php echo $data['email']?>" disabled required/>
								<input type="text" placeholder="First Name" name="fname" value="<?php echo $data['fname']?>" required/>
								<input type="text" placeholder="Last Name" name="lname" value="<?php echo $data['lname']?>" required/>
								<input type="text" placeholder="Address" name="address" value="<?php echo $data['address']?>" required/>
								<input type="text" placeholder="Phone number" name="p_number" value="<?php echo $data['p_number']?>" required/>
								<input type="text" placeholder="City" name="city" value="<?php echo $data['city']?>" required/>
								<input type="text" placeholder="Province" name="pr_st" value="<?php echo $data['pr_st']?>" required/>
								<button type="submit" class="btn btn-default" name="submit">Modify Account Settings</button>
							</div>
							
							<style type="text/css">
								.col-sm-7{
									margin-top:20px;
									margin-left: 20%;
								}
							</style>
						</form>

					</div><!--/account form-->

					
					
				</div>

			</div>
			<br/>
			<div class="col-sm-7" >
				<div class="signup-form"><!--Account-->
					<form action="./account/changePassword" method="POST">
						<h2 style="position:relative;top: 50%; left: 40%;">Change password</h2>
						<input type="password" placeholder="Password" name="password" required/>
						<input type="password" placeholder="Retype Password" name="password2" required/>
						<button type="submit" class="btn btn-default" name="submit">Change Password</button>
					</form>
				</div>
				<br />
				
				<div class="signup-form"><!--Account-->
					<form action="./account/changeBilling" method="POST">
						<h2 style="position:relative;top: 50%; left: 36%;">Change Payment method</h2>
						<label>
	                   	<input type="radio" name="ccard" value="amex" />
	                   	<img src="./images/register/amex.png">
	                 	</label>

						<label>
						 <input type="radio" name="ccard" value="master" />
						<img src="./images/register/master.png">
						</label>
						<label>
						<input type="radio" name="ccard" value="visa" />
						<img src="./images/register/visa.png">
						</label>
						<input type="password" placeholder="Credit Card Number" name="ccNumber" required/>
						<input type="password" placeholder="Card Verification Value" name="ccv" required />

						<input type="text" placeholder="Name Holder" name="nameholder"  required/>
						<select name="ccardmonth" required="required" style="width:45%;">
							<option>--Month--</option>
					        <option>January</option>
					        <option>Frebruary</option>
					        <option>March</option>
					        <option>April</option>
					        <option>May</option>
					        <option>June</option>
					        <option>July</option>
					        <option>August</option>
					        <option>September</option>
					        <option>October</option>
					        <option>November</option>
					        <option>December</option>
						</select>
						<select name="ccardyear" required="required" style="width:45%;float: right;">
					        <option>--Year--</option>
					        <option>2014</option>
					        <option>2015</option>
					        <option>2016</option>
					        <option>2017</option>
					        <option>2018</option>
					        <option>2019</option>
					        <option>2020</option>
					        <option>2021</option>
					        <option>2022</option>
					        <option>2023</option>
						</select>
						<button type="submit" class="btn btn-default" name="submit">Change Password</button>
					</form>
				</div>
			</div>
		</div>
	</section><!--/form-->


	<footer id="footer"><!--Footer-->

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 Squad Inc. All rights reserved.</p>
					<p class="pull-right">Created by <span><a >D&W</a></span></p>
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

