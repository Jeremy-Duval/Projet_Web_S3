<!DOCTYPE html>

<html lang="en">
  <head>
    <link rel="stylesheet" href="./Web/CSS/styles.css" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo("$titre"); ?></title>
  </head>
  <body>
  <header>
    <?php
      require("header/header.php");
    ?>
  </header>
    <div class="content">
      <?php
        echo("$contenu");
      ?>
    </div>
  </body>
</html>
