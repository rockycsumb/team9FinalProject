<?php
    session_start();
    include 'inc/header.php';
?>

    </head>
    <body>
        <div class="container">
        <!-- Bootstrap Navagation Bar -->
              <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <div id="addProduct">
                        <a class="btn btn-primary" href="index.php">Home</a>
                    </div>
                            
                        </ul>
                </div>
            </nav>
        <div id="prodSearch">
        <form id="searchForm" method="POST" action="inc/loginProcess.php">
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label><strong>Username</strong></label>    
                    <input type="text" class="form-control" name="username" />
                </div>  
                <div class="col-md-5 mb-3">
                    <label><strong>Password</strong></label>    
                    <input type="password" class="form-control" name="password" />
                </div> 
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <input class="btn btn-primary" type="submit" name="submitForm" value="Login" />
                </div>
            </div>
            
            
            <br /> <br />
            <?php
                if($_SESSION['incorrect']){
                    echo "<p class = 'lead' id = 'error' style='color:red'>";
                    echo "<strong> Incorrect Username or Password!</strong></p>";
                }
            ?>
        </form>
        </div>
        <?php include 'inc/footer.php'; ?>