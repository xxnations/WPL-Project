<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/register.css?time=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
        <title></title>
    </head>
    <body>
               <div id="header">
        <?php include("common/header.php"); ?>
        </div>
         <?php 
         if(empty($_SESSION['user']))
        {
            
        }
 else {
        ?>
        <div id="body">
            <?php
            
     var_dump($_POST);

     ?>
        
            
        
            <div id="errordiv">
            </div>
             </div>
          <?php } ?>
            <div id="footer">
                <?php
      include("common/footer.php"); ?>
            </div>
    </body>
</html>
