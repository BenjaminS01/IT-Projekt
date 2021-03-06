<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/styles/style1.css" type="text/css">
</head>

<body>
<!-- Nav tabs -->
<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
        <a href="?a=start" class="navbar-brand">Home</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            
            
            <?php
                if (!isset($_SESSION['id']) && !isset($_COOKIE['id'])) {
                    include 'views/loggedOutNavbar.php';
                }
            ?>
        
            
            <?php
                if (isset($_SESSION['id']) || isset($_COOKIE['id'])) {
                    include 'views/loggedInNavbar.php';
                }
            ?>
        </div>
    </nav>

    <div class="error">

    <?php
        if (isset($this->_params['error'])) {

            foreach ($this->_params['error'] as $value) {
                echo nl2br('<div class="alert alert-danger" role="alert">'. $value.'</div>' . "\r\n");
            }
            
        }
        else if(isset($_GET['message'])){
            echo nl2br('<div class="alert alert-success" role="alert">'. $_GET['message'].'</div>' . "\r\n");
        }
        else if(isset($_POST['message'])){
            echo nl2br('<div class="alert alert-success" role="alert">'. $_POST['message'].'</div>' . "\r\n");
        }
        else if(isset($this->_params['message'])){
            echo nl2br('<div class="alert alert-success" role="alert">'. $this->_params['message'].'</div>' . "\r\n");
        }else if(isset($_GET['noType'])){
            echo nl2br('<div class="alert alert-danger role="alert">Bitte Wählen Sie einen Trainingstyp</div>' . "\r\n");
        }
    ?>



    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

       
    <?php echo $body; ?>

    <footer>
      <script src="assets/js/script1.js"></script>
    </footer>
</body>