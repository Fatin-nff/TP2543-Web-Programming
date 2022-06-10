<?php
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

  <title>HijabiZ Shop</title>  
   <link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">


  <style type="text/css">
    html {
        width:100%;
        height:100%;
        min-height:100%;
      }

    .centerpage{
      text-align: center;
      margin-top: 50px;
    }

    body {
      background-image: url('images/Background.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed; 
      background-size: 100% 100%;
    }

    .btn-success {
      background-color: #DE9A99 !important;
      border-color: #DE9A99 !important;
    }

    #inputKeyword {
      border-color: #DE9A99 !important;
      border-width: 5px;
    }
  </style>
<body>
  <?php include_once 'nav_bar.php'; ?>
  <br>
  <div class="container-fluid dark" style="padding-top: 30px;">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <form action="search.php" method="post">
        <div class="col-sm-10">
          <input class="form-control" type="text" id="inputKeyword" name="search" required placeholder="Search any product based on Name, Brand or Type">
        </div>
        <div>
          <button type="submit" name="submit" class="btn btn-success search" value="search" style="color: #59282B" onclick="scroll_to_div('div1')"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <div class="centerpage">
    <br>
    <img src="images/HijabiZ Shop Logo.png" width="20%" height="20%"><br><br><br><br><br>
    <font face="Serif" size="5" color="#DE9A99"><b><i>—— Make every outfit count ——</i></b></font><br></font>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- <script type="application/javascript">
      $("button").click(function() {
      $('html,body').animate({
          scrollTop: $(".item").offset().top},
          'slow');
      });
</script> -->
<script type="application/javascript">
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