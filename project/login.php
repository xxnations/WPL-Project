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
        <?php
       if(!empty($_POST))
       {
           var_dump($_POST);
           $_SESSION['user']="username";
       }
       else
       {
        ?>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
         <?php if(!empty($_SESSION['user']))
        {
            
        }
 else {?>
        <div id="body">
            <form action="" method="POST" id="loginform">
            <table id="logintable">
                <tr>
                    <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid"/></td>
                </tr>
                <tr>
                    <td>Password </td><td><input type="password" maxlength="20" name="password" id="password"/></td>
                </tr>
                <tr align="right">
                    <td colspan="2" ><input type="submit" value="Log In" id='loginbutton' name='loginbutton'/></td>
                </tr>
            </table>
        </form>
            <div id="errordiv">
            </div>
             </div>
          <?php } ?>
            <div id="footer">
                <?php
       }include("common/footer.php"); ?>
            </div>
    </body>
</html>
