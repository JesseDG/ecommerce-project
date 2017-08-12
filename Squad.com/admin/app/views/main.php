<!DOCTYPE html>
<html>
   <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>

        <div class="row col-md-12">
            <div class="col-lg-4 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="nmbMessages"></div>
                                <div>New Messages!</div>
                            </div>
                        </div>
                    </div>
                    <a href="./inbox">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-3">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="nmbOrders"></div>
                                <div>New Orders!</div>
                            </div>
                        </div>
                    </div>
                    <a>
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right" style="height: 20px;"></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-3">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-times fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" id="nmbAlerts"></div>
                                <div>Alerts!</div>
                            </div>
                        </div>
                    </div>
                    <a href="actions">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
            <script>
                setInterval(function(){
                  $.get('Home/getNumbers',function(data){
                      obj = JSON.parse(data);
                      
                        $("#nmbMessages").html(obj['newMessages']);
                        $("#nmbOrders").html(obj['orders']);
                        $("#nmbAlerts").html(obj['alerts']);

                    });
                }, 1000);

                
            </script>

        <div class="row">
        <div class="col-lg-12">
            <h2>Orders Table</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover dataTable display" id="table_id">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Item Price</th>
                        <th>Status</th>
                        <th>Checkout Date</th>
                        <th>Sale ID</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data['allOrders'] as $order){
                        echo '<tr>';
                        echo "<td>".$order['orderID']."</td>";
                        echo "<td>".$order['itemName']."</td>";
                        echo "<td>".$order['qty']."</td>";
                        echo "<td>".$order['price']."</td>";
                        echo "<td>".$order['status']."</td>";
                        echo "<td>".$order['checkout']."</td>";
                        echo "<td>".$order['saleID']."</td>";
                        echo "<td>".$order['total']."</td>";
                        echo '</tr>';

                    }
                    ?>
                    </tbody>
                </table>
                <script>
                    $("#table_id").DataTable();
                </script>
            </div>
        </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</html>