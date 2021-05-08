<!DOCTYPE html>
<html lang="en">
  <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Inventory
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="./">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Inventory
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <h2>Item Inventory Table</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable display" id="table_id">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Item Description</th>
                                <th>Item Picture</th>
                                <th>Selling Price</th>
                                <th>Item Stock</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Bought Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($data['items'] as $item){
                                        echo '<tr>';
                                            echo "<td>$item->item_id</td>";
                                            echo "<td>$item->item_name</td>";
                                            echo "<td>$item->item_description</td>";
                                            echo '<td><img src="data:image/jpg;base64,' . base64_encode($item->item_picture) .'" width="100" height="100"/></td>';
                                            echo "<td>$item->item_price</td>";
                                            echo "<td>$item->item_stock</td>";
                                            echo "<td>". array_shift($data['cat_names']) ."</td>";
                                            echo "<td>". array_shift($data['brand_names']) ."</td>";
                                            echo "<td>$item->bought_date </td>";
                                            echo "<td>$item->status_item </td>";
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
