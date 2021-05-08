

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12" >
					<div class="signup-form"><!--sign up form-->
						<h2>New User? Sign up now!</h2>
						<form action="" method="POST">

							<div class="col-sm-7">
									<input type="email" placeholder="Email Address" name="email" value="<?php echo $data['email']?>" required/>
									<input type="password" placeholder="Password" name="password" value="<?php echo $data['password']?>" required/>
									<input type="password" placeholder="Retype Password" name="password2" value="<?php echo $data['password2']?>" required/>
							</div>
							<div class="col-sm-7">
								<input type="text" placeholder="First Name" name="fname" value="<?php echo $data['fname']?>" required/>
								<input type="text" placeholder="Last Name" name="lname" value="<?php echo $data['lname']?>" required/>
								<input type="text" placeholder="Address" name="address" value="<?php echo $data['address']?>" required/>
								<input type="text" placeholder="Phone number" name="p_number" value="<?php echo $data['p_number']?>" required/>
								<input type="text" placeholder="City" name="city" value="<?php echo $data['city']?>" required/>
								<select name="pr_st" required="required">
									<option>--Province--</option>
									
				                 	<option <?php if($data['pr_st'] == 'Alberta'){echo("selected");}?>>Alberta</option>
									<option <?php if($data['pr_st'] == 'British Columbia'){echo("selected");}?>>British Columbia</option>
									<option <?php if($data['pr_st'] == 'Manitoba'){echo("selected");}?>>Manitoba</option>
									<option <?php if($data['pr_st'] == 'New Brunswick'){echo("selected");}?>>New Brunswick</option>
									<option <?php if($data['pr_st'] == 'Newfoundland and Labrador'){echo("selected");}?>>Newfoundland and Labrador</option>
									<option <?php if($data['pr_st'] == 'Northwest Territories'){echo("selected");}?>>Northwest Territories</option>
									<option <?php if($data['pr_st'] == 'Nova Scotia'){echo("selected");}?>>Nova Scotia</option>
									<option <?php if($data['pr_st'] == 'Nunavut'){echo("selected");}?>>Nunavut</option>
									<option <?php if($data['pr_st'] == 'Ontario'){echo("selected");}?>>Ontario</option>
									<option <?php if($data['pr_st'] == 'Prince Edward Islan'){echo("selected");}?>>Prince Edward Island</option>
									<option <?php if($data['pr_st'] == 'Quebec'){echo("selected");}?>>Quebec</option>
									<option <?php if($data['pr_st'] == 'Saskatchewan'){echo("selected");}?>>Saskatchewan</option>
									<option <?php if($data['pr_st'] == 'Yukon'){echo("selected");}?>>Yukon</option>
								</select>
							</div>
							<div class="col-sm-7">
								<label>
	                     			<input type="radio" name="ccard" value="amex" <?php if($data['ccard'] == 'amex'){echo("checked");}?>/>
	                     			<img src="./images/register/amex.png">
	                  			</label>

						      	<label>
						        	 <input type="radio" name="ccard" value="master" <?php if($data['ccard'] == 'master'){echo("checked");}?>/>
						         	<img src="./images/register/master.png">
						      	</label>
						      	<label>
						         	<input type="radio" name="ccard" value="visa" <?php if($data['ccard'] == 'visa'){echo("checked");}?>/>
						         	<img src="./images/register/visa.png">
						      	</label>

								<input type="password" placeholder="Credit Card Number" name="ccNumber" value="<?php echo $data['ccNumber']?>" required/>
								<input type="password" placeholder="Card Verification Value" name="ccv" value="<?php echo $data['ccv']?>" required />
								<input type="text" placeholder="Name Holder" name="nameholder" value="<?php echo $data['nameholder']?>"  required/>
								<select name="ccardmonth" required="required" style="width: 50%;">
					                  <option>--Month--</option>
					                  <option <?php if($data['ccardmonth'] == 'January'){echo("selected");}?>>January</option>
					                  <option <?php if($data['ccardmonth'] == 'Frebruary'){echo("selected");}?>>Frebruary</option>
					                  <option <?php if($data['ccardmonth'] == 'March') {echo("selected");}?>>March</option>
					                  <option <?php if($data['ccardmonth'] == 'April') {echo("selected");}?>>April</option>
					                  <option <?php if($data['ccardmonth'] == 'May') {echo("selected");}?>>May</option>
					                  <option <?php if($data['ccardmonth'] == 'June') {echo("selected");}?>>June</option>
					                  <option <?php if($data['ccardmonth'] == 'July') {echo("selected");}?>>July</option>
					                  <option <?php if($data['ccardmonth'] == 'August') {echo("selected");}?>>August</option>
					                  <option <?php if($data['ccardmonth'] == 'September') {echo("selected");}?>>September</option>
					                  <option <?php if($data['ccardmonth'] == 'October'){echo("selected");}?>>October</option>
					                  <option <?php if($data['ccardmonth'] == 'November') {echo("selected");}?>>November</option>
					                  <option <?php if($data['ccardmonth'] == 'December') {echo("selected");}?>>December</option>
								</select>
								<select name="ccardyear" required="required" style="width:45%;float: right;">
					                  <option>--Year--</option>
					                  <option <?php if($data['ccardyear'] == '2014'){echo("selected");}?>>2014</option>
					                  <option <?php if($data['ccardyear'] == '2015'){echo("selected");}?>>2015</option>
					                  <option <?php if($data['ccardyear'] == '2016'){echo("selected");}?>>2016</option>
					                  <option <?php if($data['ccardyear'] == '2017'){echo("selected");}?>>2017</option>
					                  <option <?php if($data['ccardyear'] == '2018'){echo("selected");}?>>2018</option>
					                  <option <?php if($data['ccardyear'] == '2019'){echo("selected");}?>>2019</option>
					                  <option <?php if($data['ccardyear'] == '2020'){echo("selected");}?>>2020</option>
					                  <option <?php if($data['ccardyear'] == '2021'){echo("selected");}?>>2021</option>
					                  <option <?php if($data['ccardyear'] == '2022'){echo("selected");}?>>2022</option>
					                  <option <?php if($data['ccardyear'] == '2023'){echo("selected");}?>>2023</option>
								</select>
							</div>
							<div class="col-sm-7">
								<button type="submit" class="btn btn-default" name="submit">Sign up</button>
							</div>
							<style type="text/css">
								.col-sm-7{
									margin-top:20px;
									margin-left: 20%;
								}
							</style>
						</form>
					</div><!--/sign up form-->
					<?php
					if($data['valid'] == false) //doesnt work
						{

							echo 'returnStr:'.$data['returnStr'];
						}
					?>
				</div>
			</div>
		</div>
	</section><!--/form-->


	<footer id="footer"><!--Footer-->

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
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


