<?php
	require_once 'database.php';

	if (isset($_SESSION['loggedin']))
    	header("LOCATION: index.php");

	if (isset($_POST['useremail'], $_POST['userpassword'])) {
	    $userID = htmlspecialchars($_POST['useremail']);
	    $userPassword = $_POST['userpassword'];

    if (empty($userID) || empty($userPassword)) {
        $_SESSION['error'] = 'Please fill in the blanks.';
    } else {
        $stmt = $db->prepare("SELECT * FROM tbl_staffs_a175116_pt2 WHERE (fld_staff_email = :id) LIMIT 1");
        $stmt->bindParam(':id', $userID);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['fld_staff_email'])) {
            if ($user['fld_staff_password'] == $userPassword) {
                unset($user['fld_staff_password']);
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user;

                header("LOCATION: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Invalid login credentials. Please try again.';
            }
        } else {
            $_SESSION['error'] = 'Account does not exist.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>Welcome to HijabiZ Shop</title>
  	<link rel="shortcut icon" type="image/x-icon" href="images/HijabiZ Shop Icon.ico"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Maven+Pro:wght@500;800&family=Open+Sans:wght@300&family=Public+Sans:wght@300&display=swap" rel="stylesheet">

    <style type="text/css">
        .button {
            font-family: 'Maven Pro', sans-serif;
            font-size: 3rem;
            width: 250px;
            height: 55px;
            background-color: #663337;
            border: 1px solid #663337;
            border-radius: 10px;
            color: white;
            list-style-type: none;
            margin: 10px;
            padding: 5px;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>
<body>

	<div class="containers">
        <div class="page-header center-div">
            <h1>Welcome To</h1>
        </div>
        <div class="login-form">
        	
          	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
          		<img src="images/HijabiZ Shop Logo - Maroon.png" width="40%" height="35%" class="center"><br>
      			<input type="email" class="userInput" id="inputUserID" name="useremail" placeholder="Email" width="40%"><br>
				<input type="password" class="userInput" id="inputUserPass" name="userpassword" placeholder="Password"><br>

				<?php
					if(isset($_SESSION['error'])) { 
						echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
                   		unset($_SESSION['error']);
					}
				?>

				<br>
				<input class="button" type="submit" value="Login"><br>

			</form> 			
		</div>   		
	</div>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>