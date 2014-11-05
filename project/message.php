
        <h4>
        <?php
        session_start();
        if(!empty($_SESSION['message']))
        {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        }
        ?>
        </h4>
