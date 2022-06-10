<?php
include 'index.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
    <title>HijabiZ Shop - Search</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">

</head>

<style type="text/css">
    /*html {
        scroll-behavior: smooth;
    }*/

    * {
      font-family: 'Maven Pro', sans-serif;
    }

    body {
      background-image: url('images/Background.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }

    .btn1 {
      width: 80px;
      background-color: #27A84A !important;
      border-color: #27A84A !important;
      color: white;
    }
  </style>

<body>

<br><br><br><br><br>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <table class="table table-striped table-bordered item" id="div1">
                <tr style="font-weight:bold; color : #59282B; background-color: #DE9A99;">
                    <th width="8%"><center>Collection Name</center></th>
                    <th width="8%"><center>Brand</center></th>
                    <th width="8%"><center>Type</center></th>
                    <th width="5%"></th>
                </tr>
                <body>
                <?php
                $result = array();
                if (isset($_POST['search'])) {
                    $keywords = explode(" ", $_POST['search']);

                    if (count($keywords) == 2) {
                        $name = "%" . $keywords[0] . "%";
                        $brand = "%" . $keywords[1] . "%";
                        

                        $stmt = $db->prepare("SELECT * FROM tbl_products_a175116_pt2 WHERE fld_product_collection LIKE :name AND fld_product_brand LIKE :brand AND fld_product_type LIKE :type ORDER BY fld_product_num ASC");
                        $stmt->bindParam(":name", $name);
                        $stmt->bindParam(":brand", $brand);
                        

                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } elseif (count($keywords) == 1) {
                        $search = "%{$keywords[0]}%";
                        $stmt = $db->prepare("SELECT * FROM `tbl_products_a175116_pt2` WHERE fld_product_collection LIKE :param OR fld_product_brand LIKE :param OR fld_product_type LIKE :param ORDER BY fld_product_num ASC");
                        $stmt->bindParam(":param", $search);

                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        echo "<tr><td colspan='6'>No information available. (<p class='text-danger'>Please check you search keywords.</p>)</td></tr>";
                    }
                } else {
                    $stmt = $db->query("SELECT * FROM tbl_products_a175116_pt2 ORDER BY fld_product_num ASC LIMIT 0,10");
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }

                if (count($result) > 0) {
                    foreach ($result as $readrow) {
                        if (empty($readrow['fld_product_image'])) {
                            $readrow['fld_product_image'] = "{$readrow['fld_product_num']}.jpg";
                        }
                        ?>
                        <tr bgcolor="#FFFBCE">
                            <!-- <td><center><?php echo $readrow['fld_product_num']; ?></center></td> -->
                            <td><center><?php echo $readrow['fld_product_collection']; ?></center></td>
                            <td><center><?php echo $readrow['fld_product_brand']; ?></center></td>
                            <td><center><?php echo $readrow['fld_product_type']; ?></center></td>
                            <td class="text-center">
                                <a target="_blank"
                                   href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs btn1" role="button">Details</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No information available.</td></tr>";
                }
                ?>
                </body>
            </table>
        </div>
    </div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script>

<script type="application/javascript">
    $('#imageModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const imgUrl = button.data('img');
        const productName = button.data('name');

        const modal = $(this);
        modal.find('.modal-title').text(`${productName}'s image`);
        modal.find('.product-image').prop('title', `${productName}'s image`);
        modal.find('.product-image').attr('src', 'products/' + imgUrl);
    });

    $('.product-image').on("error", function () {
        this.src = 'products/nophoto.jpg';
    });

//     $(".search").click(function() {
//     $('html,body').animate({
//         scrollTop: $(".item").offset().top},
//         'slow');
// });
    function scroll_to_div(div_id) {
     $('html,body').animate(
     {
      scrollTop: $("#"+div_id).offset().top
     },
     'slow');
    }
</script>
</body>
</html>
