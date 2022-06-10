<!DOCTYPE html>
<html>
<head>
<meta>
  <title><?php echo $title; ?></title>
</head>
 
<body bgcolor="#92B1B6" text="#000000">
  <ol>
    <?php
    foreach ($result as $record): ?>
      <li>
      <b>Name : </b><?php echo $record->user; ?><br>
      <b>Email : </b><?php echo $record->email; ?><br>
      <b>Date / Time : </b><?php echo $record->postdate." / ".$record->posttime; ?><br>
      <b>Comment : </b><?php echo nl2br($record->comment); ?><br>
      <b>Action : </b><a href="<?php echo base_url('myguestbook/edit/'); echo $record->id; ?>">Edit</a>
      / <a href="<?php echo base_url('myguestbook/remove/'); echo $record->id; ?>">Delete</a>
      <hr>
      </li>
    <?php endforeach; ?>
  </ol>
  <div align="center">
    [ <a href="<?php echo base_url('myguestbook/create/'); ?>">Add</a> ]
  </div>
</body>
  
</html>