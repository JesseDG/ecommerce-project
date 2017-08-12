<!DOCTYPE html>
<html lang="en">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">
					Add Item
				</h1>
				<ol class="breadcrumb">
					<li>
						<i class="fa fa-dashboard"></i>  <a href="./">Dashboard</a>
					</li>
					<li class="active">
						<i class="fa fa-file"></i> Add Item
					</li>
				</ol>
			</div>
		</div>
		<!-- /.row -->
		
		        <!-- display the content first -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Items Already Inserted</h2>
                <table class="table table-bordered table-hover" id="itemsDataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Picture</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($data['items'] as $item){
                            echo "<tr>";
                                echo "<td> $item->item_id</td>";
                                echo "<td> $item->item_name</td>";
                                echo '<td> <img src="data:image/jpg;base64,' . base64_encode($item->item_picture) . '" width="100 height=50" /></td>';
                                echo "<td> $item->item_price$</td>";
                                echo "<td> $item->status_item</td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <div class="col-lg-12">
                    <h2 class="page-header">Form adding Item</h2>
                    <form class="form-group" id="_form" action="" method="post" enctype="multipart/form-data">

                        <div class="col-lg-12" style="margin-bottom:50px;">
                            <div class="col-lg-4">
                              <label for="user">Item Name</label>
                              <input type="text" class="form-control" name="iname" autocomplete="off">
                            </div>

                            <div class="col-lg-4">
                                <label for="image">Item Image</label>
                                <input type="file" name="image" class="">
                            </div>

                            <div class="col-lg-4">
                                <label for="password">Item Description</label>
                                <textarea type="password" class="form-control" rows="10" name="idescription"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12" style="margin-bottom:50px;">
                            <div class="col-lg-4">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" name="iprice" autocomplete="off">
                            </div>

                            <div class="col-lg-4">
                                <label for="stock">Stock</label>
                                <input type="text" class="form-control" name="istock" autocomplete="off">
                            </div>

                            <div class="col-lg-4" id="sandbox-container">
                                <label for="boughtDate">Date it has been bought</label>
                                <input type="text" class="form-control" name="ib_date" autocomplete="off">

                                <script type="text/javascript">
                                    $('#sandbox-container input').datepicker({});
                                </script>

                            </div>
                        </div>

                        <div class="col-lg-12" style="margin-bottom:50px;">
                            <div class="col-lg-4">
                                <label>Brand</label>
                                <select class="form-control" name="ibrand">
                                    <?php
                                    foreach ($data['brands'] as $brand){

                                        echo "<option> $brand->brand_name </option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label>Category</label>
                                <select class="form-control" name="icategory">
                                    <?php
                                        foreach ($data['categories'] as $cat){

                                            echo "<option> $cat->category_name </option>";
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label>Status</label>
                                <select class="form-control" name="istatus">
                                    <option value="Available">Available</option>
                                    <option value="Disable">Unavailable</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <div class="col-lg-2">
                            <input type="submit" class="btn btn-success form-control" name="submit">
                        </div>
                    </form>
                    <script>

                    </script>

                </div>
            </div>
        </div>

	</div>
	<!-- /.container-fluid -->
</html>
