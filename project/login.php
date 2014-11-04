<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
       }
       else
       {
        ?>
        <div id="header">
        <?php include("common/header.php"); ?>
        </div>
        <div id="body">
            <form action="" method="POST" id="registrationform">
            <table id="registertable">
                <tr>
                    <td>First Name </td><td><input type="text" maxlength="20" name="firstname" id="firstname"/></td>
                </tr>
                <tr>
                    <td>Last Name </td><td><input type="text" maxlength="20" name="lastname" id="lastname"/></td>
                </tr>
                <tr>
                    <td>Email </td><td><input type="email" maxlength="20" name="emailid" id="emailid"/></td>
                </tr>
                <tr>
                    <td>Password </td><td><input type="password" maxlength="20" name="password" id="password"/></td>
                </tr>
                <tr>
                    <td>Retype Password </td><td><input type="password" maxlength="20" name="repassword" id="repassword"/></td>
                 </tr>
                <tr>   
                    <td>Gender </td><td><input type="radio" name="gender" id="Male" value="Male">Male</td>
                </tr>
                <tr>
                    <td> </td><td><input type="radio" name="gender" id="Female" value="Female">Female</td>
                    
                </tr>
                <tr align="right">
                    <td colspan="2" ><input type="submit" value="register" id='registerbutton' name='registerbutton'/></td>
                </tr>
            </table>
        </form>
            <div id="errordiv">
            </div>
             </div>
            <div id="footer">
                <?php
       }include("common/footer.php"); ?>
            </div>
    </body>
</html>
