<?php $titre="Détails du Film";
ob_start();
?>

<!-- Script pour la flèche -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
  $(document).ready(function () {
      $(window).scroll(function () {
          if ($(this).scrollTop() > 100) {
              $('.scrollup').fadeIn();
          } else {
              $('.scrollup').fadeOut();
          }
      });
      $('.scrollup').click(function () {
          $("html, body").animate({
              scrollTop: 0
          }, 600);
          return false;
      });
  });
</script>

<!-- Début de la zone d'affichage des infos du film -->
<h1 class="movie-name"><?php echo($data_info_movie['Titre']);?></h1>
<div class="infobox text-center">
  <div class="table-title">
    <h2>Informations sur le film</h2>
  </div>
  <table>
    <thead>
      <tr>
        <th>Année du tournage</th>
        <th>Score du film</th>
        <th>Nombres de votes</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <?php
          echo("<td>".$data_info_movie['Année']."</td>");
          echo("<td>".$data_info_movie['Score']."</td>");
          echo("<td>".$data_info_movie['Votes']."</td>");
      ?>
      </tr>
    </tbody>
  </table>

  <!-- Bouton de vote et vérification si l'utilisateur à déjà voté -->
  <?php
  if(isset($_SESSION['login'])){
    if ($voted==true){
       echo("<span class='button' id='no-cursor'>Vous avez déjà voté pour ce film</span>");
    }else{
       echo("<form action='index.php?movieid=".$p_movieid."' method='post'>");
       echo("<input type='submit' class='button' name='voteButton' value='Voter pour ce film' />");
       echo("</form>");
    }
  }
  ?>
</div>

<!-- Affichage du casting -->
<div class="casting">
  <div class="table-title">
    <h2>Casting du film</h2>
  </div>
  <table class="table-fill">
    <thead>
      <tr>
        <th></th>
        <th>Nom</th>
      </tr>
    </thead>
    <tbody class="table-hover">
      <?php
      if (isset($p_movieid)){
        foreach ($data_info_casting as $ligne) {
          echo("<tr>");
          echo("<td>".$ligne['Ordinal']."</td>");
          echo("<td>".$ligne['Nom']."</td>");
          echo("</tr>");
        }
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Début de la zone de commentaire -->
<div class="comment-area">

  <div class="comment-list">
    <h2>Commentaires</h2>
    <ul>
        <?php
          foreach ($commentAside as $ligneComm) {
              echo("<li><h3 class='login-name'>".$ligneComm['Login']."</h3><span>&emsp;".$ligneComm['Comment']."</span><hr></li>");
          }
        ?>
    </ul>
  </div>


  <div class="comment-submission form">
    <?php
      echo("<form action='index.php?movieid=".$p_movieid."' method='post'>");
    ?>
      <input type="text" name="message"  placeholder="Ecrivez votre commentaire ici"/>
      <input type="submit" value="Poster" class="button"/>
    </form>
    <?php
      if(!isset($_SESSION['login'])){
        echo "<p class='message'>Veuillez vous connectez pour envoyer un commentaire !</p>";
      }
    ?>
  </div>
</div>
<a href="#" class="scrollup">Scroll</a>


<?php
  $contenu=ob_get_clean();
  require("Views/layout.php");
?>
