<!DOCTYPE html>
<?php
require ('core.php');
require_once('../main/connect.php');
require('../main/main.php');
ob_start();
session_start();
$user = $_SESSION['username'];

if(!isset($_SESSION['admin'])){
  header("Location:login.php?err=expired");
}

if(isset($_POST['cari'])){
  $tata = $_POST['cari'];
  //$tata = preg_replace("#[^0-9a-z]#i","",$tata);
  $qr = mysql_query("SELECT * from PRODUCT where uuid LIKE '%$tata%' OR brand LIKE '%$tata%' OR type LIKE '%$tata%'") or die("".mysql_error());
  $chk = mysql_num_rows($qr);
}
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MoDe Admin Panel</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->

        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Welcome , <?php echo $_SESSION['admin'] ?>,  &nbsp; <a href="../main/logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
           <!-- /. NAV TOP  -->
                <?php sideMenu(); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Product List</h2>
                        <h5>All Registered product will be listed here</h5>

                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />

            <div class="row">
              <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        Action
                      </div>
                      <div class="panel-body">
                        <a href="addProduct.php" class="btn btn-danger">Add new product</a>
                      </div>
                  </div>
                  <!--End Advanced Tables -->
              </div>
              <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="panel panel-primary">
                      <div class="panel-heading">
                        Search Product
                      </div>
                      <div class="panel-body">
                        <form method="post" action="productList.php">
                        <input type="text" class="input-sm" name="cari"> <button type="submit" class="btn btn-primary">Search</button>
                      </form>
                      <hr>
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered table-hover">
                              <thead>
                                  <tr>
                                    <th>Brand</th>
                                    <th>type</th>
                                    <th>code</th>
                                    <th>action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                if($chk == 0 || $tata == NULL){
                                  echo '';

                                }else
                                {
                                  while ($brang = mysql_fetch_array($qr)){
                                 ?>
                                  <tr>
                                      <td><?php echo $brang['brand'] ?></td>
                                      <td><?php echo $brang['type'] ?></td>
                                      <td><?php echo $brang['uuid'] ?></td>
                                      <td><a href="editProduct.php?id=<?php echo $brang['uuid'] ?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>  Edit Product</button></a>
                                      <a href="delete.php?id='<?php echo $brang['uuid'] ?>'"><button class="btn btn-danger"><span class="glyphicon glyphicon-pencil"></span>  Delete Product</button></a></td>
                                  </tr>
                                  <?php }} ?>

                              </tbody>
                          </table>
                      </div>

                      </div>
                  </div>
                  <!--End Advanced Tables -->
              </div>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Product Table
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>Brand</th>
                                            <th>type</th>
                                            <th>code</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php listProduct(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-6">
                  <!--   Kitchen Sink -->

                     <!-- End  Kitchen Sink -->
                </div>

            </div>
                <!-- /. ROW  -->

                <!-- /. ROW  -->

                <!-- /. ROW  -->
        </div>

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
