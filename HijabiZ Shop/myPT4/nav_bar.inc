<?php
include_once 'database.php';
?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">

<style type="text/css">
  
  /*.nav-title {
    font-family: 'Abril Fatface', cursive;
    font-size: 3rem;
  }*/

  .nav-title {
    font-size: 3rem;
  }

  * {
    font-family: 'Maven Pro', sans-serif;
  }
  .navbar-center {
    font-family: 'Maven Pro', sans-serif;
    font-size: 20px;
    justify-content: center;
  }

  .navbar-right {
    font-family: 'Maven Pro', sans-serif;
    font-weight: bold;
    font-size: 20px;
  }
</style>

<nav class="navbar navbar-default">
  <div class="container-fluid" style="background-color:#DE9A99 ;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand nav-title" href="index.php" style="color: #59282B"><b>HijabiZ Shop —</b></a>
    </div>
    <div class="navbar-brand navbar-center" id="roles" style="color: #59282B" text><?php echo $_SESSION['user']['fld_staff_role'].' | '.$_SESSION['user']['fld_staff_nickname']?></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">

            <!-- <li><a href="search.php" style="color: #59282B">Search</a> -->
            <li><a href="products.php" style="color: #59282B">Products</a></li>
            <li><a href="customers.php" style="color: #59282B">Customers</a></li>
            <li><a href="staffs.php" style="color: #59282B">Staffs</a></li>
            <li><a href="orders.php" style="color: #59282B">Orders</a></li>
            <li><a href="userLogout.php" data-toggle="tooltip" id="out" title="Logout" style="color: black"><span class="glyphicon glyphicon-log-out"></span></a></li>
          <!-- </ul>
        </li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- <script type="text/javascript">
  $(function(){
    $("#out").tooltip({
        placement: "bottom",
        title: "Log Out"
    });
});
</script> -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>