<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form</title>
  <style>
    .centerpage{
      text-align: center;
      margin-top: 130px;
    }
  </style>
</head>  
<body bgcolor="#92B1B6" text="#000000">

<?php echo validation_errors(); ?>
    <form name="form1" method="post" action="">
      <table width="100%" border="0" cellpadding="4">
        <tr>
        <td colspan="1" bgcolor="#223e4a">
          <h1><font size="6" color="ffffff" face="verdana">&ensp;Form</font></h1>
        </td>
        </tr>
      </table>        
      <div class="centerpage">
        <div align="center">  
          <table width="500" height="400" border="3" bordercolor="#223e4a">   
            <tr>
            <td height="190" bgcolor="#DDDDDD">
              <div align="center">
                Name :
                <input type="text" name="name" size="40">
                <br><br>
                Email :
                <input type="text" name="email" size="25">
                <br><br>
                Comment :<br>
                <textarea name="comment" cols="30" rows="8"></textarea>
                <br><br>
                <input type="hidden" name="form-submitted" value="add" />
                <input type="submit" name="Submit" value="Add a New Comment">
                <input type="reset">
                <br>
              </div>
            </td>
            </tr>
          </table>
        </div>
      </div>    
    </form> 
</body>
</html>