<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include('Databaseadapter.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/common.css?time=<?php echo time(); ?>">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="js/common.js?time=<?php echo time(); ?>"></script>
        <title></title>
    </head>
    <body>
        <table>
            <tr><th>Topic Name</th><th>Price</th><th>Add to Cart</th></tr>
        
        <?php
        
        $databaseadapter=new Databaseadapter();
        $result=$databaseadapter->getTopics();
        while($row = mysql_fetch_array($result))
        {
           echo "<tr><td>".$row['topicname']."</td><td>".$row['price']."</td><td><button class=\"addtocartbutton\"  name=".$row['topicid'].":".$row['topicname'].">Add to Cart</button></td></tr>";
        }
?>
        </table>
    </body>
</html>
