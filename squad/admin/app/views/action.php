<!DOCTYPE html>
<html lang="en">
    <div class="container-fluid" ng-app="loadItemInfo" ng-controller="itemCtrl">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Edits
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bar-chart-o"></i>Action
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="col-lg-12">
            <div class="row">
                <h2 class="page-header">Actions</h2>
            </div>
        </div>

            <script>

 
            </script>
        
        <div class="col-lg-12">
                <h2>Update order status</h2>
            <div class="col-lg-4 col-lg-offset-4" style="margin-bottom: 5%;">
                <h3 class="page-header">Choose the Status to modify</h3>
                <select class="form-control" name="" id="selectStatus">
                    <option>Select Status</option>
                    <option>Paid</option>
                    <option>Cancellation Process</option>
                </select>
                <div class="col-lg-4 col-lg-offset-4" style="margin-top:15px;">
                    <input type="submit" class="btn btn-success form-control" name="submit" value="GO" id="goID">
                    
                </div>
            </div>

            <!--form class="form-group" id="item_form" action="edit/updateItem" method="post" enctype="multipart/form-data"-->

                    <div class="row">

                            <!---------------------------- EDIT ITEM------------------------------>
                            <div class="col-lg-12 col-lg-offset-3" style="margin-bottom:50px;">

                                <div class="col-lg-3">
                                  <label for="user">Order ID</label>
                                    <select class="form-control" name="iname" autocomplete="off" id="allOrdersID">
                                    </select>
                                </div>
                                
                                <div class="col-lg-3">
                                  <label for="user">New Status</label>
                                  <input type="text" class="form-control" name="iname" autocomplete="off" id="newStatus">
                                </div>
                                                               
                                
                            </div>
                            <div class="col-lg-2 col-lg-offset-5">
                                <input type="submit" class="btn btn-success form-control" id="submitNewStatus" >
                            </div>
                    </div>
                <!--/form-->
                
                <script>
                    $("#goID").click(function(){

                        text = $('#selectStatus').find(":selected").text();
                        
                        if(text === "Paid"){
                            
                            $("#allOrdersID").html("");
                             $("#newStatus").val("shipped");
                             $.getJSON('actions/getPaidOrders').done(function(data){
                                 
                                 values = data.records;
                                 for(i=0; i < values.length; i++ ){
                                     
                                     console.log(values[i].ID);
                                     
                                    option = document.createElement("OPTION");
                                    option.appendChild(document.createTextNode(values[i].ID));
                                     $("#allOrdersID").append(option);
                                 }
 
                                 
                             });

                        }
                        else{
                            
                             $("#allOrdersID").html("");
                             $("#newStatus").val("Cancellation Completed");
                            $.getJSON('actions/getProcessCancellation').done(function(data){
                                                               
                                 values = data.records;
                                 for(i=0; i < values.length; i++ ){
                                     
                                     console.log(values[i].ID);
                                     
                                    option = document.createElement("OPTION");
                                    option.appendChild(document.createTextNode(values[i].ID));
                                     $("#allOrdersID").append(option);
                                 }
 
                                 
                            });
                        }


                    });
                    
                    $("#submitNewStatus").click(function(){
                       
                        orderID = $("#allOrdersID").find(":selected").text();
                        newStatus = $("#newStatus").val();
                        
                        $.post
                        (
                            'actions/updateOrder',
                            {
                                id: orderID,
                                status: newStatus
                            },
                            function(data){
                                
                                alert(orderID + " has been successfully updated!"); 
                                location.reload();
                                                              
                            }
                        )
                        
                    });
                </script>
                <!-----------------------------  --------------------------------------->
            <div class="col-lg-12">
                <h2>Running out of Items</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable display" id="table_id">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Bought Date</th>
                                <th>Status</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($data['itemsLess'] as $item){
                                    echo '<tr>';
                                        echo "<td>".$item->item_id."</td>";
                                        echo "<td>".$item->item_name."</td>";
                                        echo "<td>".$item->item_stock."</td>";
                                        echo "<td>".$item->bought_date."</td>";
                                        echo "<td>".$item->status_item."</td>";
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

                <!--------------------------------  --------------------------------------->

            <div class="col-lg-12">
                <h2>View of cancelled orders and update status</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable display" >
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Item Name</th>
                                <th>User</th>
                                <th>Current Status</th>
                                <th>New Status</th>
                                <th>Update</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($data['cancels'] as $info){
                                        echo '<tr>';
                                            echo "<td>".$info['id']."</td>";
                                            echo "<td>".$info['itemName']."</td>";
                                            echo "<td>".$info['user']."</td>";
                                            echo "<td>".$info['status']."</td>";
                                            echo "<td>Cancellation Process</td>";
                                            echo "<td><button class=\"btn btn-default\" onclick=\"updateCancellation(this)\" value=\"".$info['id']."\">Submit</button></td>";
                                        echo '</tr>';

                                    }
                            ?>
                        </tbody>
                        <script>
                            function updateCancellation(e){
                                text = $(e).attr("value");
                                newStatus = "Cancellation Process";
                                
                                $.post
                                (
                                    'actions/updateOrder',
                                    {
                                        id: text,
                                        status: newStatus
                                    },
                                    function(data){

                                        alert(text + " has been successfully updated!"); 
                                        location.reload();

                                    }
                                )
                            }
                        </script>
                    </table>
                    <script>
                        $("#table_id").DataTable();
                    </script>
                </div>
            </div>


        </div>
    <!-- /.container-fluid -->
</html>
