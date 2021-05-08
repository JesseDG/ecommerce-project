
	 
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row" >
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
				</div>
			</div>
			<div id="message-container"style="height: 500px;" class="col-lg-12" value="<?php echo $data['user'] ?>">
                    <div id="leftSide" class="col-lg-6">
                        <div id="thread"style="max-height: 450px; overflow-y: auto">

                            <?php 
                                foreach($data['data'] as $message){
                                echo "<div class=\"panel panel-default\" style=\"height: inherit; cursor:pointer\" id=\"".$message['msgID']."\" onclick=\"displayMessage(this)\">
                                        <div class=\"panel-body\" style=\"height: inherit\">
                                            <div  style=\"float: left\"><img src=\"../public/images/admin.png\" height=\"30\" width=\"30\"></div>
                                            <div><p style=\"font-size: 1.4em;float: left;padding-top: 1%\">Admin</p></div>
                                            <div class=\"col-sm-5\" style=\"float: right;\"><p style=\"font-size: 1.1em;padding-top: 2%;\">". $message['date']."</p></div>
                                            <div class=\"col-sm-12\">
                                                <i class=\"fa fa-envelope\" style=\"display: inline-block\"></i>
                                                <span id=\"preview".$message['msgID'] ."\" style=\"text-overflow: ellipsis;width:420px;display: inline-block;overflow: hidden !important;white-space:nowrap\">". $message['content']."</span></div>
                                        </div>
                                    </div>";
                                }
                                    
                            ?>
                        </div>
                        <div id="compose" >
                            <button type="button" onclick="composeMessage()" class="btn btn-default" id="composeMsg">Compose Message</button>
                        </div>
                    </div>
                    <div id="rightSide" style="height: 1000px" class="col-lg-6">
                        <div id="subject" style="display: none;"><p style="border-bottom: 1px solid">Subject:<span style="margin-left: 10px;" id="spanSubject"></span></p></div>
                        <div class="row" style="float: left">
                            <div class="panel panel-default" id="messageBox-adminReply" style="display: none">
                                <div class="panel-body">
                                    <span style="width: 500px;overflow-x: auto;display: block" id="spanMsg">
                                    </span>
                                </div>
                            </div>
                            <div class="panel panel-default" id="newMsg" style="display: none;background-color: #F0F0E9 ">
                                    <div class="panel-body" style="padding-bottom: 5%;">
                                        <div  id="NewMessage" style=";height:140px;width:525px;">
                                            <!--form-->
                                                <textarea style="display:block;height:100px;width:525px;" rows="10" class="form-control"></textarea>
                                                <br>
                                                <button type="submit" class="btn btn-default" id="trigger" onclick="sendMessage()">Send</button>
                                            <!--/form-->
                                        </div>
                                    </div>
                            </div>

                            </div>
                        </div>
                        
                            
                        
                        
			</div>
    	</div>
    </div><!--/#contact-page-->
	<footer id="footer"><!--Footer-->		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2016 Squad Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer><!--/Footer-->
	

  
    <script src="./js/jquery.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="./js/gmaps.js"></script>
	<script src="./js/contact.js"></script>
	<script src="./js/price-range.js"></script>
    <script src="./js/jquery.scrollUp.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>