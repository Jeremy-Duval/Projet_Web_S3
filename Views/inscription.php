<?php
  $titre="Page de Connexion";
  ob_start();
?>
<div class="login-page">
  <div class="form">
    <form enctype="multipart/form-data" action="index.php?action=inscription_sent" method="post" class="login-form">
      <input type="text" name="nom" placeholder="Entrer votre nom"><br>
      <input type="text" name="login" placeholder="Entrer votre nom d'utilisateur"><br>
      <input type="password" name="password" placeholder="Entrer votre mot de passe"><br>
      <input type="password" name="password2" placeholder="Confirmer votre mot de passe"><br>
      <input type="email" name="mail" placeholder="Entrer votre mail"><br>
      <input type="file" name="profilpic" id="profilepic-upload">
      <label for="profilepic-upload" class="button">Choississez une image de profil</label>
      <input type="submit" value="S'incrire" class="button">
      <?php
        if(isset($messageErreur)){
          if($messageErreur==0){
            echo("<p class='erreur'>Veuillez renseigner tout les champs</p>");
          }else if($messageErreur==1){
            echo("<p class='erreur'>Ce nom n'est pas autorisé : veuillez ne rentrer que des lettres ou des chiffres</p>");
          }else if($messageErreur==2){
            echo("<p class='erreur'>Ce mot de passe n'est pas autorisé : veuillez ne rentrer que des lettres ou des chiffres</p>");
          }else if($messageErreur==3){
            echo("<p class='erreur'>Les mots de passes ne sont pas identiques</p>");
          }else{
            echo("<p class='erreur'>Ce nom d'utilisateur existe déjà</p>");
          }
        }else{}
        ?>
      <p class="message">Déjà inscris ? <a href="index.php?action=connexion">Connectez-vous</a></p>
    </form>
  </div>
</div>

<?php
  $contenu=ob_get_clean();
  require("Views/layout.php");
?>
