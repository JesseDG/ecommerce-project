    <div class="col-lg-12 col-lg-offset-1">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Order History</li>
            </ol>
        </div>
    </div>

    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <h2 style="display:block;text-align:center;">Orders History</h2>
            <div class="table-responsive" style="width:80%;margin: 0 auto;">
                <table class="table table-bordered table-hover dataTable display"  id="table_id">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Status</th>
                        <th>Checkout Date</th>
                        <th>Total</th>
                        <th>Cancel Pending orders</th>

                    </tr>
                    </thead>
                    <tbody>
                    	<?php
		                    foreach ($data['allOrders'] as $order){
		                        echo '<tr id="#row' . $order['orderID'] . '">';
		                        echo "<td>".$order['orderID']."</td>";
		                        echo "<td>".$order['itemName']."</td>";
		                        echo "<td>".$order['qty']."</td>";
		                        echo "<td>".$order['price']."</td>";
		                        echo "<td>".$order['status']."</td>";
		                        echo "<td>".$order['checkout']."</td>";
		                        echo "<td>".$order['price'] * $order['qty'] ."$</td>";
                                if($order['status'] == 'paid')
                                {
                                    echo '<td><button class="cancelOrder" value="' . $order['orderID'] . '">cancel</button></td>';
                                }
                                else
                                {
                                    echo "<td></td>";
                                }
		                        echo '</tr>';

                    		}
                    ?>
                        <script>
                                $(document).ready(function(){

                                    $(".cancelOrder").click(function(){
                                        orderID = $(this).attr("value");
                                        
                                        console.log(orderID);
                                        
                                        $.ajax({
                                            url:"orderHistory/cancelOrder/"+orderID,
                                            success: function(result){
                                                location.reload();
                                            }

                                        });
                                    });
                                });

                        </script>
                    </tbody>
                </table>
                
                
            </div>
        </div>
    </div>
    <!-- /.row -->
    </div>


<
	

  
    <script src="./js/jquery.js"></script>
	<script src="./js/price-range.js"></script>
    <script src="./js/jquery.scrollUp.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>