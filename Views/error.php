<?php $titre="Page d'erreur";
  $nError=(int)$_GET['n'];
  if($nError==1){
    ob_start();
      echo("<img alt='ERROR : Vous avez saisi manuellement un identifiant de film non autorisé' src='Web/images/error_img.jpg' width='720' height='510'>");
      echo("ERROR : Vous avez saisi manuellement un identifiant de film non autorisé");
    $contenu=ob_get_clean();
  }else if($nError==2){
    ob_start();
      echo("<img alt='ERROR : Vous avez saisi manuellement un identifiant de film non autorisé' src='Web/images/error_img.jpg' width='720' height='510'>");
      echo("ERROR : Vous avez saisi un nom");
    $contenu=ob_get_clean();
  }else{
    echo("Numéro d'erreur non indiqué");
  }

  require("Views/layout.php");
?>
