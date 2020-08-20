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
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Trainingskalender</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="?a=login" class="nav-link">Accountverwaltung</a>
                </li>
                <li class="nav-item">
                    <a href="?a=kalender" class="nav-link">Kalender</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="error">

    <?php
        if (isset($this->_params['error'])) {

            foreach ($this->_params['error'] as $value) {
                echo nl2br($value . "\r\n");
            }
            
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