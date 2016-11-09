<?php
  $titre="Page de Connexion";
  ob_start();
?>
<div class="login-page">
  <div class="form">
    <form action="index.php?action=connexion_sent" method="post" class="login-form">
      <input type="text" name="login" placeholder="Entrer votre nom d'utilisateur"><br>
      <input type="password" name="password" placeholder="Entrer votre mot de passe"><br>
      <input type="submit" value="Log In" class="button">
      <?php
        if(isset($messageErreur)){
          if($messageErreur==0){
            echo("<p class='erreur'>Veuiller entrer votre login et mot de passe</p>");
          }else if($messageErreur==1){
            echo("<p class='erreur'>Le login est incorrect</p>");
          }else{
            echo("<p class='erreur'>Le mot de passe pour ".$login." est incorrect</p>");
          }
        }
      ?>
      <p class="message">Pas inscris? <a href="index.php?action=inscription">Créer un compte</a></p>
    </form>
  </div>
</div>
<?php
  $contenu=ob_get_clean();
  require("Views/layout.php");
?>
