<?php
  include_once 'database.php';
?>
<?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a175116, tbl_staffs_a175116_pt2, tbl_customers_a175116_pt2, tbl_orders_details_a175116 WHERE tbl_orders_a175116.fld_staff_num = tbl_staffs_a175116_pt2.fld_staff_num AND tbl_orders_a175116.fld_customer_num = tbl_customers_a175116_pt2.fld_customer_num AND tbl_orders_a175116.fld_order_num = tbl_orders_details_a175116.fld_order_num AND tbl_orders_a175116.fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>HijabiZ Shop - Invoice</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">

  <style type="text/css">
    * {
      font-family: 'Maven Pro', sans-serif;
    }

    body {
      background-image: url('images/Background 2.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
  </style>
</head>
<body>
  <!-- LOGO -->
  <div class="row">
    <div class="col-xs-6 text-center">
      <br>
      <img src="images/HijabiZ Shop Logo.png" width="35%" height="35%">
    </div>
    <div class="col-xs-6 text-right">
      <h1>INVOICE</h1>
      <h5>Order: <?php echo $readrow['fld_order_num'] ?></h5>
      <h5>Date: <?php echo $readrow['fld_order_date'] ?></h5>
    </div>
  </div>
  <hr>


  <div class="row">
    <!-- SHOP ADDRESS -->
    <div class="col-xs-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>From: HijabiZ Shop Sdn. Bhd.</h4>
        </div>
        <div class="panel-body">
          <p>
            Lot L2-17, Jalan Taman Melawati <br>
            Taman Melawati <br>
            53100 Ampang <br>
            Wilayah Persekutuan Kuala Lumpur <br>
          </p>
        </div>
      </div>
    </div>
    <!-- CUSTOMER ADDRESS -->
    <div class="col-xs-5 col-xs-offset-2 text-right">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>To : <?php echo $readrow['fld_customer_name'] ?></h4>
        </div>
        <div class="panel-body">
          <p>
            Address 1 <br>
            Address 2 <br>
            Postcode City <br>
            State <br>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLE PRODUCT -->
  <table class="table table-bordered">
    <tr>
      <th class="text-center">No</th>
      <th>Product</th>
      <th class="text-right">Quantity</th>
      <th class="text-right">Price(RM)/Unit</th>
      <th class="text-right">Total(RM)</th>
    </tr>
    <?php
    $grandtotal = 0;
    $counter = 1;
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a175116, tbl_products_a175116_pt2 WHERE tbl_orders_details_a175116.fld_product_num = tbl_products_a175116_pt2.fld_product_num AND fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $result = $stmt->fetchAll();
    }
    catch(PDOException $e){
      echo "Error: " . $e->getMessage();
    }
    foreach($result as $detailrow) {
    ?>
    <tr>
      <td><center><?php echo $counter; ?></center></td>
      <td><?php echo $detailrow['fld_product_collection']; ?></td>
      <td class="text-right"><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
      <td class="text-right"><?php echo $detailrow['fld_product_price']; ?></td>
      <td class="text-right"><?php echo $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity']; ?></td>
    </tr>
    <?php
      $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity'];
      $counter++;
    } // while
    ?>
    <tr>
      <td colspan="4" class="text-right">Grand Total</td>
      <td class="text-right"><?php echo $grandtotal ?></td>
    </tr>
  </table>


  <div class="row">
    <!-- CUSTOMER BANK DETAIL -->
    <div class="col-xs-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Bank Details</h4>
        </div>
        <div class="panel-body">
          <p>Your Name:</p>
          <p>Bank Name:</p>
          <p>SWIFT : </p>
          <p>Account Number : </p>
          <p>IBAN : </p>
        </div>
      </div>
    </div>

    <!-- STAFF CONTACT DETAIL -->
    <div class="col-xs-7">
      <div class="span7">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Contact Details</h4>
          </div>
          <div class="panel-body">
            <p> Staff: <?php echo $readrow['fld_staff_name'] ?> </p>
            <p> Email: <?php echo $readrow['fld_staff_email'] ?> </p>
            <p> Phone Number: <?php echo $readrow['fld_staff_phone'] ?> </p>
            <p><br></p>
            <p><br></p>
            <p>Computer-generated invoice. No signature is required.</p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- <center>
    <br>
    <font size="5" color="#AA7777"><b>HijabiZ Shop Sdn. Bhd. </b></font><br>
    Lot L2-17, Jalan Taman Melawati <br>
    Taman Melawati <br>
    53100 Ampang <br>
    Wilayah Persekutuan Kuala Lumpur <br>
    <br>
    <hr>   
    
    <font color="59282B"><b>Order ID: </b></font><?php echo $readrow['fld_order_num'] ?> &ensp;|&ensp;
    <font color="59282B"><b>Order Date: </b></font><?php echo $readrow['fld_order_date'] ?>
    <hr>
    <font color="59282B"><b>Staff: </b></font><?php echo $readrow['fld_staff_name'] ?> &ensp;|&ensp;
    <font color="59282B"><b>Customer ID: </b></font><?php echo $readrow['fld_customer_name'] ?> &ensp;|&ensp;
    <font color="59282B"><b>Date: </b></font><?php echo date("d M Y"); ?>
    <hr>
    <br>
    <table border="1" cellpadding="6">
      <tr bgcolor="#DE9A99">
        <td><center><font color="59282B"><b>No</b></font></center></td>
        <td><center><font color="59282B"><b>Product</b></font></center></td>
        <td><center><font color="59282B"><b>Quantity</b></font></center></td>
        <td><center><font color="59282B"><b>Price(RM)/Unit</b></font></center></td>
        <td><center><font color="59282B"><b>Total(RM)</b></font></center></td>
      </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a175116, tbl_products_a175116_pt2 where  tbl_orders_details_a175116.fld_product_num = tbl_products_a175116_pt2.fld_product_num AND fld_order_num = :oid");
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr bgcolor="#FFFBCE">
        <td><center><?php echo $counter; ?></center></td>
        <td><?php echo $detailrow['fld_product_collection']; ?></td>
        <td><center><?php echo $detailrow['fld_order_detail_quantity']; ?></center></td>
        <td><center><?php echo $detailrow['fld_product_price']; ?></center></td>
        <td><center><?php echo $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity']; ?></center></td>
      </tr>
      <?php
        $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_order_detail_quantity'];
        $counter++;
      } // while
      $conn = null;
      ?>
      <tr bgcolor="#FFFBCE">
        <td colspan="4" align="right"><font color="59282B"><b>Grand Total</b></font></td>
        <td><center><?php echo $grandtotal ?></center></td>
      </tr>
    </table>
    <br>
    <hr>
    <b>Computer-generated invoice. No signature is required.</b>
 
  </center> -->
</body>
</html>