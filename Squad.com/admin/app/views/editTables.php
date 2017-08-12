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
                        <i class="fa fa-bar-chart-o"></i> Edit item
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="col-lg-12">
            <div class="row">
                <h2 class="page-header">Form editing Item</h2>
            </div>
        </div>

            <script>

 
            </script>
        
        <div class="col-lg-12">

            <div class="col-lg-4 col-lg-offset-4" style="margin-bottom: 5%;">
                <h3 class="page-header">Choose item first</h3>
                <select class="form-control" name="itemName" id="selectItem">
                    <option>Select Item</option>
                    <?php
                    foreach ($data['allItems'] as $item){
                        echo "<option value='$item->item_id'> $item->item_name </option>";
                    }
                    ?>
                </select>
                <div class="col-lg-4 col-lg-offset-4" style="margin-top:15px;">
                    <input type="submit" class="btn btn-success form-control" name="submit" value="GO" id="goItem" ng-click="myfunction()">
                </div>
            </div>

            <form class="form-group" id="item_form" action="edit/updateItem" method="post" enctype="multipart/form-data">

                    <div class="row">

                            <!---------------------------- EDIT ITEM------------------------------>
                            <div class="col-lg-12" style="margin-bottom:50px;">

                                <!-- ITEM NAME -->
                                <div class="col-lg-3">
                                  <label for="user">Item Name</label>
                                  <input type="text" class="form-control" name="iname" autocomplete="off" id="nameSelect" ng-model="itemName">
                                </div>

                                <!-- ITEM IMAGE-->
                                <div class="col-lg-4 col-lg-offset-1">
                                    <label for="image">Item Image</label>
                                    <br>
                                    <img ng-src="data:image/JPEG;base64,{{image}}" width="170" height="150">
                                    <input type="file" name="image" class="">
                                </div>

                                <!-- ITEM DESCRIPTION-->
                                <div class="col-lg-4">
                                    <label for="password">Item Description</label>
                                    <textarea type="password" class="form-control" rows="10" name="idescription" id="descSelect" ng-model="itemDesc"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-12" style="margin-bottom:50px;">

                                <!-- ITEM PRICE-->
                                <div class="col-lg-4">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="iprice" autocomplete="off" id="priceSelect" ng-model="itemPrice">
                                </div>

                                <!-- ITEM STOCK -->
                                <div class="col-lg-4">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" name="istock" autocomplete="off" id="stockSelect" ng-model="itemStock">
                                </div>

                                <!-- ITEM BOUGHT DATE-->
                                <div class="col-lg-4" id="sandbox-container">
                                    <label for="boughtDate">Date it has been bought</label>
                                    <input type="text" class="form-control" name="ib_date" autocomplete="off" id="dateSelect" ng-model="itemDate">

                                    <script type="text/javascript">
                                        $('#sandbox-container input').datepicker({});
                                    </script>

                                </div>
                            </div>

                            <div class="col-lg-12" style="margin-bottom:50px;">

                                <!-- BRAND NAME-->
                                <div class="col-lg-4">
                                    <div class="ui-widget">
                                        <label for="Brand">Brand</label>
                                        <select id="selectBrand" class="form-control" name="newbrand"></select>
                                    </div>
                                </div>

                                <!-- CATEGORY NAME-->
                                <div class="col-lg-4">
                                    <label>Category</label>
                                    <select id="selectCategory"  class="form-control" name="newCategory"></select>
                                </div>

                                <!-- ITEM STATUS-->
                                <div class="col-lg-4">
                                    <label>Status</label>
                                    <select id="statusOptions" class="form-control" name="status">
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-success form-control" name="submitItem">
                            </div>
                    </div>
                </form>
                

                <!----------------------------- EDIT BRAND --------------------------------------->
                <form id="form_edit_brand" method="post" action="edit/updateBrand">
                    <div class="col-lg-12" style="margin-top:5%;">
                        <h2 class="page-header">Form editing brand</h2>
                        <div class="row">
                                <div class="col-lg-4">
                                    <label for="Brand">Select Brand</label>
                                    <select id="selectBrand" class="form-control" name="brandID">
                                     <?php
                                        foreach ($data['allBrands'] as $brand){
                                            echo "<option value='$brand->brand_id'>$brand->brand_name</option>";
                                        }
                                    ?>
                                    </select>
                                </div>

                            <div class="col-lg-3">
                                <label for="Brand">Set new name</label>
                                <input type="text" class="form-control" name="newBrand" autocomplete="off" id="" required>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-2" style="margin-top:5%;">
                        <input type="submit" class="btn btn-success form-control" name="submitBrand">
                    </div>
                </form>

                <!-------------------------------- EDIT CATEGORY --------------------------------------->

                <form id="form_edit-category" method="post" action="edit/updateCategory" style="height:900px;">
                    <div class="col-lg-12" style="margin-top:10%;">
                        <h2 class="page-header">Form editing category</h2>
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="Brand">Select Category Name</label>
                                <select class="form-control" name="category" id="statusCategory">
                                    <option></option>
                                    <?php
                                    foreach ($data['allCategories'] as $cat){
                                        echo "<option value='$cat->category_id'>$cat->category_name</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                <label for="Brand">Set New Category Name</label>
                                <input class="form-control" name="newCategory" id="newCategory" >
                            </div>

                            <div class="col-lg-4">
                                <label for="Brand">Set New Status</label>
                                <select id="statusCategoryOptions"  class="form-control" name="newStatus">
                                    <option>Available</option>
                                    <option>Unavailable</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2" style="margin-top:5%;">
                        <input type="submit" class="btn btn-success form-control" name="submitCategory">
                    </div>
                </form>


        </div>
    <!-- /.container-fluid -->
</html>
