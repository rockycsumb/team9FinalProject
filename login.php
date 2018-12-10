<?php
    session_start();
    include 'inc/header.php';
?>

<body>
    <div class="sticky-top">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand" href="#">E-Wheels</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link" href="index.php">Home </a>
              <!-- <a class="nav-item nav-link" href="#">Features</a> -->
              <a class="nav-item nav-link active" href="admin.php">Admin Page<span class="sr-only">(current)</span></a>
            </div>
          </div>
        </div>
      </nav>
    </div>
    
  <div class="container">
    <div id="prodSearch">
      <form id="searchForm" method="POST" action="inc/loginProcess.php">
        <h4 id="pageTitle">Administrator Login</h4>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label><strong>Username</strong></label>    
            <input type="text" class="form-control" name="username" />
          </div>  
          <div class="col-md-6 mb-3">
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