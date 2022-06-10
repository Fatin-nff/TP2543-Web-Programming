<?php
  
include_once 'database.php';
 
if (!isset($_SESSION['loggedin']))
  header("LOCATION: userLogin.php");

//Create
if (isset($_POST['create'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
  try {
 
    $stmt = $db->prepare("INSERT INTO tbl_customers_a175116_pt2(fld_customer_num, fld_customer_name, fld_customer_phone, fld_customer_address) VALUES(:cid, :name, :phone, :address)");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);

    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address =  $_POST['address'];
       
    $stmt->execute();

    } catch (PDOException $e) {
            $_SESSION['error'] = "Error while creating: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "You are not an ADMIN. Permission to create a new customer is not granted.";
    }

    header("LOCATION: {$_SERVER['REQUEST_URI']}");
    exit();
}
 
//Update
if (isset($_POST['update'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') { 
  try {
 
    $stmt = $db->prepare("UPDATE tbl_customers_a175116_pt2 SET fld_customer_num = :cid, fld_customer_name = :name, fld_customer_phone = :phone, fld_customer_address = :address WHERE fld_customer_num = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address =  $_POST['address'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
 
    } catch (PDOException $e) {
            $_SESSION['error'] = "Error while updating: " . $e->getMessage();
            header("LOCATION: {$_SERVER['REQUEST_URI']}");
            exit();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to update customer.";
    }

    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
}
 
//Delete
if (isset($_GET['delete'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
  try {
 
    $stmt = $db->prepare("DELETE FROM tbl_customers_a175116_pt2 WHERE fld_customer_num = :cid");  
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);      
    $cid = $_GET['delete'];   
    $stmt->execute();
    } catch (PDOException $e) {
            $_SESSION['error'] = "Error while deleting: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to delete customer.";
    }

    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
}
 
//Edit
if (isset($_GET['edit'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') { 
  try {
 
    $stmt = $db->prepare("SELECT * FROM tbl_customers_a175116_pt2 WHERE fld_customer_num = :cid"); 
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);    
    $cid = $_GET['edit'];  
    $stmt->execute();
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    
    } catch (PDOException $e) {
            $_SESSION['error'] = "Error while editing: " . $e->getMessage();
            header("LOCATION: {$_SERVER['PHP_SELF']}");
            exit();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to edit a customer.";
        header("LOCATION: {$_SERVER['PHP_SELF']}");
        exit();
    }
}
 
  $conn = null;

$num = $db->query("SELECT MAX(fld_customer_num) AS cid FROM tbl_customers_a175116_pt2")->fetch()['cid'];
if ($num){
  $num = ltrim($num, 'C')+1;
  $num = 'C'.str_pad($num,3,"0",STR_PAD_LEFT);
}
else{
  $num = 'C'.str_pad(1,3,"0",STR_PAD_LEFT);
}
?>