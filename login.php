<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CST336: Team 9 Final Project Need Store Name</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Mukta" rel="stylesheet">
    </head>
    <body>
        <h1> Store Name: Product Search </h1>
        <h3> Admin login</h3>
        <div id="search">
        <form id="searchForm" method="POST" action="inc/loginProcess.php">
            Username: <input type="text" name="username" /> <br />
            Password: <input type="password" name="password" /> <br />
            
            <input type="submit" name="submitForm" value="Login!" />
            <br /> <br />
            <?php
                if($_SESSION['incorrect']){
                    echo "<p class = 'lead' id = 'error' style='color:red'>";
                    echo "<strong> Incorrect Username or Password!</strong></p>";
                }
            ?>
        </form>
        </div>
        <div id="footer">
            <hr>
            <br /><br />
            <p>
                CST 336 Internet Programming 2018 &copy; Team 9 <br />
                This website is for academic purposes only.
                <br /><br />
                <img src="img/logo.png" alt="CSUMB logo">
            </p>
        </div>
    </body>
</html>