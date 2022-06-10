<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <style>
    .centerpage{
      text-align: center;
      margin-top: 250px;
    }
  </style>
</head>
<body bgcolor="#92B1B6">

<?php date_default_timezone_set("Asia/Kuala_Lumpur"); ?>
<div class="centerpage">
  <div align="center">
    <table width="379" height="286" border="3" bordercolor="#223e4a">
      <tr>
        <td height="190" bgcolor="#DDDDDD">
            <p align="center"><font size="6" color="223e4a" face="Helvetica"><strong>My Guestbook</strong></font></p>
            <p align="center"><font size="4" color="223e4a" face="Helvetica">Date : <?php echo date("d-m-Y",time()); ?></font></p>
            <p align="center"><font size="4" color="223e4a" face="Helvetica">Time : <?php echo date("h:i",time()); ?></font></p>
            <p align="center"><font size="4" color="223e4a" face="Helvetica"><a href="<?php echo base_url('myguestbook/create/'); ?>">Add</a> | <a href="<?php echo base_url('myguestbook/view/'); ?>">List</a></font></p>
        </td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>