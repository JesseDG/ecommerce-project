<!DOCTYPE html>
<html lang="en">
  <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Selling Ranks
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="./">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> Best sellers to Worst Sellers
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <h2>Selling analysis</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable display" id="table_id">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th># of Times ordered</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($data['sellers'] as $display){
                                    echo '<tr>';
                                        echo "<td>".$display['itemName']."</td>";
                                        echo "<td>".$display['size']."</td>";
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
