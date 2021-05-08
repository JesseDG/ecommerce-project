
<!DOCTYPE html>
<html lang="en" style="height:100%;margin:0">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <base href="/Squad.com/admin/public/">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- jQuery -->
    <!--script src="js/jquery.js"></script-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-datepicker.en-AU.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="js/customize.js"></script>

</head>

<body  style="height:100%;">

    <div id="wrapper" style="height:100%;">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Squad.com Administrator</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin']?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="home/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="navbar-default sidebar" role="navigation">
                <ul class="nav navbar-nav side-nav">
                    <li style="margin-top: 15%;">
                        <a href="./"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="edit/editTables"><i class="fa fa-fw fa-table"></i>  Edit Tables </a>
                    </li>
                    <li>
                        <a href="inventory"><i class="fa fa-database"></i> Inventory</a>
                    </li>

                    <li>
                        <a href="inbox"><i class="fa fa-fw fa-edit"></i> Messages</a>
                    </li>
                    <li>
                        <a href="Actions"><i class="fa fa-pencil"></i> Actions</a>
                    </li>
                    <li>
                        <a><i class="fa fa-fw fa-arrows-v"></i> Add to database</i></a>
                        <ul id="add" class="nav nav-second-level">
                            <li>
                                <a href="add/addingItem">Add Item</a>
                            </li>
                            <li>
                                <a href="add/addingBrand">Add Brand</a>
                            </li>
                            <li>
                                <a href="add/addingCategory">Add Category</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="rankSellers"><i class="fa fa-area-chart"></i> Selling Ranks</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">
        
       