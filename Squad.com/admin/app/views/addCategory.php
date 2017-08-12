<!DOCTYPE html>
<html lang="en">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Add Category
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="./">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Add Category
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <!-- display the content first -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Categories Already Inserted</h2>
            <div class="col-lg-4 col-lg-offset-4">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                        foreach ($data['categories'] as $cat){

                            echo "<tr>";
                                echo "<td> $cat->category_id</td>";
                                echo "<td> $cat->category_name</td>";
                                echo "<td> $cat->status</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12">
                <h2 class="page-header">Form adding Category</h2>
                <form class="form-group" id="_form" action="" method="post" enctype="multipart/form-data" style="margin-bottom: 15%;">

                    <div class="col-lg-12" style="margin-bottom:50px;">
                        <div class="col-lg-4 col-lg-offset-4">
                            <label for="user">Category Name</label>
                            <input type="text" class="form-control" name="cname">
                            <br>
                            <label for="user">Status</label>
                            <select class="form-control" name="status">
                                <option value="Available">Available</option>
                                <option value="Disable">Disable</option>
                            </select>
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
