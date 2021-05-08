<!DOCTYPE html>
<html>
    
    <head>
        <base href="/Squad.com/admin/public/">
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    </head>
    <body>
        
        <div class="container container-table">
            <div class="row vertical-center-row">
                <div class="col-md-12">
                    <div class="col-md-4 col-md-offset-4" id="box">
                        <h3 style="text-align:center; font-family: 'Audiowide', cursive ">Squad.com Login Admin</h3>

                        <form class="form-group" id="_form" action="" method="post">
                            <label for="user">Admin name:</label>
                            <input type="text" class="form-control" name="uname">
                            <br>
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="upass">
                            <br>
                            <br>
                            <input type="submit" class="btn btn-success form-control" name="submit">
                        </form>
                    </div>
                </div>

            </div>

              </div>

                <style>
                html, body{
                    background-color:#222;
                    height: 100%;
                }
            #box{
                background-color:white; 
                box-shadow: 20px 20px 30px black;
            }
            #_form{
                padding-bottom: 20%;
            }
            h3{
                padding-top: 20%;
                padding-bottom: 20%;
            }
            .container{
                height: 100%;
            }            
            .container-table {
                height: 100%;
                display: table;
            }
            .vertical-center-row {
                display: table-cell;
                vertical-align: middle;
}
        </style>
        
        
    </body>

</html>