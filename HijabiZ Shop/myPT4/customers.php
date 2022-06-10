<?php
  include_once 'customers_crud.php';
  require_once 'database.php';

  if (!isset($_SESSION['loggedin']))
    header("LOCATION: userLogin.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>HijabiZ Shop - Customers</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">
 
  <style type="text/css">
    * {
      font-family: 'Maven Pro', sans-serif;
    }

    body {
      background-image: url('images/Background.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-size: 100% 100%;
    }

    .btn1, .btn2 {
      width: 80px;
    }

    .btn2 {
      margin-top: 10px;
    }

  </style>
</head>
<body>
  <?php include_once 'nav_bar.inc'; ?>
  
  <?php if($_SESSION['user']['fld_staff_role'] == 'Admin'){ ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Customer</h2>
        </div>

        <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>

        <form action="customers.php" method="post">
          <div class="form-group">
            <label for="customerid" class="col-sm-3 control-label">Customer ID</label>
            <div class="col-sm-9">
              <input name="cid" type="text" class="form-control" id="customerid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_num']; else echo $num ?>" readonly><br>
            </div>
          </div>

          <div class="form-group">
            <label for="customername" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
              <input name="name" type="text" class="form-control" id="customername" placeholder="Customer Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>" required><br>
              </div>
          </div>

          <div class="form-group">
            <label for="customernum" class="col-sm-3 control-label">Phone Number</label>
            <div class="col-sm-9">
              <input name="phone" type="text" class="form-control" id="customernum" placeholder="Customer Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phone']; ?>" required><br>
            </div>
          </div>

          <div class="form-group">
            <label for="customeraddress" class="col-sm-3 control-label">Address</label>
            <div class="col-sm-9">
              <input name="address" type="text" class="form-control" id="customeraddress" placeholder="Customer Address" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_address']; ?>" required><br>
            </div>
          </div> 
              
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">  
              <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldcid" value="<?php echo $editrow['fld_customer_num']; ?>" required>
              <button class="btn btn-success" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
              <?php } else { ?>
              <button class="btn btn-success" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
              <?php } ?>
              <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>
  <!-- <br> -->
    
    <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="page-header">
          <h2>Customers List</h2>
        </div>
        <table class="table table-striped table-bordered">
          <tr>
            <th bgcolor="#DE9A99"><center><font color="59282B"><b>Customer ID</b></font></center></th>
            <th bgcolor="#DE9A99"><center><font color="59282B"><b>Name</b></font></center></th>
            <th bgcolor="#DE9A99"><center><font color="59282B"><b>Phone Number</b></font></center></th>
            <th bgcolor="#DE9A99"><center><font color="59282B"><b>Address</b></font></center></th>
            <th bgcolor="#DE9A99"></th>

          </tr>
        <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_customers_a175116_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr bgcolor="#FFFBCE">
        <td><center><?php echo $readrow['fld_customer_num']; ?></center></td>
        <td><?php echo $readrow['fld_customer_name']; ?></td>
        <td><?php echo $readrow['fld_customer_phone']; ?></td>
        <td><?php echo $readrow['fld_customer_address']; ?></td>
        
        <td class="text-center">
          <?php
            if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
          ?>
          <a href="customers.php?edit=<?php echo $readrow['fld_customer_num']; ?>" class="btn btn-success btn-xs btn1" role="button"> Edit </a>
          <a href="customers.php?delete=<?php echo $readrow['fld_customer_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs btn2" role="button">Delete</a>
        </td>
        <?php } ?>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_customers_a175116_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    <br><br>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
    <script src="js/bootstrap.min.js"></script>
</body>
</html>