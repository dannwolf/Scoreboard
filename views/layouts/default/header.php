<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Framework</title>
    <link rel="stylesheet" href="<?php echo $layoutParams["route_css"];?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $layoutParams["route_css"];?>/style.css">
    <script src="<?php echo $layoutParams["route_js"];?>/jquery.min.js"></script>
    <script src="<?php echo $layoutParams["route_js"];?>/bootstrap.min.js"></script>

  </head>
  <body>
    <div class="container">
    <?php
    if (isset($flashMessage)) {
      echo $flashMessage;
    }?>
