<?php 
  include_once 'orders_crud.php';
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

  <title>HijabiZ Shop - Orders</title>
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
      background-size: 100% 100%;
    }

    .btn1, .btn2, .btn3 {
      width: 80px;
    }

    .btn2, .btn3  {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <?php include_once 'nav_bar.inc'; ?>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Order</h2>
        </div>

        <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="form-horizontal">
          <div class="form-group">
            <label for="orderid" class="col-sm-3 control-label">Order ID</label>
            <div class="col-sm-9">
              <input name="oid" type="text" class="form-control" id="orderid" placeholder="Order ID" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="orderdate" class="col-sm-3 control-label">Order Date</label>
            <div class="col-sm-9">
              <input name="orderdate" type="text" class="form-control" id="orderdate" placeholder="Order Date" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>" required>
            </div>
          </div>
               
          <div class="form-group">
            <label for="orderstaff" class="col-sm-3 control-label">Staff</label>
            <div class="col-sm-9">     
              <select name="sid" class="form-control" id="orderstaff" required>
                <option value="" selected>Please select</option>
              <?php
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a175116_pt2");
                $stmt->execute();
                $result = $stmt->fetchAll();
              }
              catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
              }
              foreach($result as $staffrow) {
              ?>
                <?php if((isset($_GET['edit'])) && ($editrow['fld_staff_num']==$staffrow['fld_staff_num'])) { ?>
                  <option value="<?php echo $staffrow['fld_staff_num']; ?>" selected><?php echo $staffrow['fld_staff_name'];?></option>
                <?php } else { ?>
                  <option value="<?php echo $staffrow['fld_staff_num']; ?>"><?php echo $staffrow['fld_staff_name'];?></option>
                <?php } ?>
              <?php
              } // while
              $conn = null;
              ?> 
              </select>
            </div>
          </div>
              
          <div class="form-group">
            <label for="ordercustomer" class="col-sm-3 control-label">Customer</label>
            <div class="col-sm-9">
              <select name="cid" class="form-control" id="ordercustomer" required>
                <option value="" selected>Please select</option>
              <?php
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_customers_a175116_pt2");
                $stmt->execute();
                $result = $stmt->fetchAll();
              }
              catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
              }
              foreach($result as $custrow) {
              ?>
                <?php if((isset($_GET['edit'])) && ($editrow['fld_customer_num']==$custrow['fld_customer_num'])) { ?>
                  <option value="<?php echo $custrow['fld_customer_num']; ?>" selected><?php echo $custrow['fld_customer_name']?></option>
                <?php } else { ?>
                  <option value="<?php echo $custrow['fld_customer_num']; ?>"><?php echo $custrow['fld_customer_name']?></option>
                <?php } ?>
              <?php
              } // while
              $conn = null;
              ?> 
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">  
              <?php if (isset($_GET['edit'])) { ?>
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
  <br>
  
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Orders List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Order ID</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Order Date</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Staff ID</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Customer ID</b></font></center></th>
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
          $sql = "SELECT * FROM tbl_orders_a175116, tbl_staffs_a175116_pt2, tbl_customers_a175116_pt2 WHERE ";
          $sql = $sql."tbl_orders_a175116.fld_staff_num = tbl_staffs_a175116_pt2.fld_staff_num and ";
          $sql = $sql."tbl_orders_a175116.fld_customer_num = tbl_customers_a175116_pt2.fld_customer_num";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll();
        }
        catch(PDOException $e){
              echo "Error: " . $e->getMessage();
        }
        foreach($result as $orderrow) {
        ?>
        <tr bgcolor="#FFFBCE">
          <td><?php echo $orderrow['fld_order_num']; ?></td>
          <td><?php echo $orderrow['fld_order_date']; ?></td>
          <td><?php echo $orderrow['fld_staff_name'] ?></td>
          <td><?php echo $orderrow['fld_customer_name'] ?></td>
          <td>
            <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-warning btn-xs btn1" role="button">Details</a><br>

            <?php
              if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
            ?>
            <a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>" class="btn btn-success btn-xs btn2" role="button"> Edit </a><br>
            <a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs btn3" role="button">Delete</a>
            <?php } ?>
          </td>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_orders_a175116");
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
            <li><a href="orders.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"orders.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"orders.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="orders.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    <br><br>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>