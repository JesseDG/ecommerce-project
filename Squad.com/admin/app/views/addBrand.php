<!DOCTYPE html>
<html lang="en">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Add Brand
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="./">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Add Brand
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- display the content first -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Brands Already Inserted</h2>
                <div class="col-lg-4 col-lg-offset-4" >
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Brand Name</th>
                        </tr>
                        </thead>
                                
                        <tbody>
                            <?php
                            
                                foreach($data['brands'] as $brand){
                                    echo '<tr>';
                                        echo "<td>$brand->brand_id</td>";
                                        echo "<td>$brand->brand_name</td>";
                                    echo '</tr>';
                                }
                            
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-12">
                    <h2 class="page-header">Form adding Brand</h2>
                    <form class="form-group" id="_form" action="" method="post" style="margin-bottom: 10%;">

                        <div class="col-lg-12" style="margin-bottom:50px;">
                            <div class="col-lg-4 col-lg-offset-4">
                                <label for="user">Brand Name</label>
                                <input type="text" class="form-control" name="bname">
                            </div>

                        </div>
                        <br>
                        <div class="col-lg-2 col-lg-offset-5">
                            <input type="submit" class="btn btn-success form-control" name="submit">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</html>
