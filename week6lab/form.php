<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="insert.php">
  Name :
  <input type="text" name="name" size="40" required>
  <br><br>
  Email :
  <input type="text" name="email" size="25" required>
  <br><br>
  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required></textarea>
  <br><br>
  <input type="submit" name="add_form" value="Add a New Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>
