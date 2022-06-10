<?php
  include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>HijabiZ Shop - Products</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">
 
  <style>
    
  </style>

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

    .item {
      text-align: left;
    }
    
    input[type="file"] {
      display: none !important;
    }

    .btn1, .btn2, .btn3 {
      width: 80px;
      margin-top: 10px;
    }

    .btn1 {
      margin-top: 50px;
    }

    </style>
</head>
<body>
  <?php include_once 'nav_bar.inc'; ?>
  
  <div class="container-fluid dark" style="padding-bottom: 30px;">
    <?php if($_SESSION['user']['fld_staff_role'] == 'Admin'){ ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header">
          <h2>Create New Product</h2>
        </div>

        <?php
          if (isset($_SESSION['error'])) {
            echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
          }
        ?>
      </div>

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

          <div class="col-md-8">
          <div class="form-group">
            <label for="productid" class="col-sm-3 control-label item">Product ID</label>
            <div class="col-sm-9">
              <input name="pid" type="text" class="form-control" id="productid" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; else echo $num?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="productname" class="col-sm-3 control-label item">Collection Name</label>
            <div class="col-sm-9">     
              <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_collection']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productbrand" class="col-sm-3 control-label item">Brand</label>
            <div class="col-sm-9">                
              <select name="brand" class="form-control" id="productbrand" required>
                <option value="" selected>Please select</option>
                <option value="Alhumaira" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Alhumaira") echo "selected"; ?>>Alhumaira</option>
                <option value="Naelofar" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Naelofar") echo "selected"; ?>>Naelofar</option>
                <option value="Tudung People" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Tudung People") echo "selected"; ?>>Tudung People</option>
                <option value="Umma" <?php if(isset($_GET['edit'])) if($editrow['fld_product_brand']=="Umma") echo "selected"; ?>>Umma</option>
              </select>
            </div>
          </div>


          <div class="form-group">
            <label for="producttype" class="col-sm-3 control-label item">Type</label>
            <div class="col-sm-9">       
              <input name="type" type="text" class="form-control" id="producttype" placeholder="Product Type" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_type']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productcolor" class="col-sm-3 control-label item">Color</label>
            <div class="col-sm-9">                  
              <input name="color" type="text" class="form-control" id="productcolor" placeholder="Product Color" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_color']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productmaterial" class="col-sm-3 control-label item">Material</label>
            <div class="col-sm-9">          
              <input name="material" type="text" class="form-control" id="productmaterial" placeholder="Product Material" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_material']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productmeasurement" class="col-sm-3 control-label item">Measurement</label>
            <div class="col-sm-9">    
              <input name="measurement" type="text" class="form-control" id="productmeasurement" placeholder="Product Measurement" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_measurement']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productprice" class="col-sm-3 control-label item">Price</label>
            <div class="col-sm-9">    
              <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="productstock" class="col-sm-3 control-label item">Stock</label>
            <div class="col-sm-9">         
              <input name="stock" type="number" class="form-control" id="productstock" placeholder="Product Stock" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_stock']; ?>" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">  
              <?php if (isset($_GET['edit'])) { ?>
              <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>" required>
              <button class="btn btn-success" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
              <?php } else { ?>
              <button class="btn btn-success" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
              <?php } ?>
              <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
            </div>
          </div>
        </div>
      

          <div class="col-md-4" style="height: 100%">
              <div class="thumbnail dark-1">
                <img src="products/<?php echo(isset($_GET['edit']) ? $editrow['fld_product_image'] : '') ?>" class="img-responsive" onerror="this.onerror=null;this.src='products/nophoto.jpg';" id="productPhoto" alt="Product Image" style="width: 100%;height: 300px;">
                <div class="caption text-center">
                  <h3 id="productImageTitle" style="word-break: break-all;">Product Image</h3>
                  <p>
                    <label class="btn btn-primary">
                      <input type="file" accept="image/*" name="fileToUpload" id="inputImage"
                           onchange="loadFile(event);"/>
                      <input type="hidden" name="filename" value="<?php echo $editrow['fld_product_image']; ?>">
                      <span class="glyphicon glyphicon-cloud" aria-hidden="true"></span> Browse
                    </label>
                  </p>
                </div>
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
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">
        <tr>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Product ID</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Collection Name</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Brand</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Type</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Color</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Material</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Measurement</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Price (RM)</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Stock</b></font></center></th>
          <th bgcolor="#DE9A99"><center><font color="59282B"><b>Image<br></b></font></center></th>
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
         $stmt = $conn->prepare("SELECT * FROM tbl_products_a175116_pt2 LIMIT $start_from, $per_page");
    
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr bgcolor="#FFFBCE">
        <td><center><?php echo $readrow['fld_product_num']; ?></center></td>
        <td><?php echo $readrow['fld_product_collection']; ?></td>
        <td><?php echo $readrow['fld_product_brand']; ?></td>
        <td><?php echo $readrow['fld_product_type']; ?></td>
        <td><?php echo $readrow['fld_product_color']; ?></td>
        <td><?php echo $readrow['fld_product_material']; ?></td>
        <td><?php echo $readrow['fld_product_measurement']; ?></td>       
        <td><center><?php echo $readrow['fld_product_price']; ?></center></td>
        <td><center><?php echo $readrow['fld_product_stock']; ?></center></td>
        <?php 
          if(file_exists('products/'. $readrow['fld_product_image']) && isset($readrow['fld_product_image'])){
            $img = 'products/'.$readrow['fld_product_image'];
            echo '<td><img data-toggle="modal" data-target="#'.$readrow['fld_product_num'].'" width=150px; src="'.$img.'"></td>';
          }
          else {
            $img = 'products/nophoto.jpg';
            echo '<td><img width=150px%; data-toggle="modal" data-target="#'.$readrow['fld_product_num'].'" src="products/nophoto.jpg"'.'></td>';
          } 
        ?>

        <div id="<?php echo $readrow['fld_product_num']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-body">
            <img src="<?php echo $img ?>" class="img-responsive">
          </div>
        </div>

        <td class="text-center">

          <a href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs btn1" role="button">Details</a><br>
          <?php
            if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') { ?>
              <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs btn2" role="button"> Edit </a><br>
              <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs btn3" role="button">Delete</a>
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
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a175116_pt2");
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
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    <br><br>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
  <script src="js/bootstrap.min.js"></script>
  <script type="application/javascript">
    var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
      var output = document.getElementById('productPhoto');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
    document.getElementById('productImageTitle').innerText = event.target.files[0]['name'];
  };

  $(document).ready(function () {
    $("#productlist").DataTable({
    "lengthMenu": [[5, 20, 50, -1], [5, 20, 50, "All"]]
  });
  });
  </script>
</body>
</html>