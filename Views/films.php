<?php $titre="Liste des films référencés";
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

<!-- Affichage des films de la base de données -->
    <div class="table-title">
      <h1>Liste des films -</h1>
      <h2><?php echo("$count")?> film(s) trouvé(s) dans la base de données.</h2>
    </div>
    <table class="table-fill">
      <thead>
        <tr>
          <th class="text-left">Titre</th>
          <th class="text-center">Année</th>
          <th class="text-center">Scores</th>
          <th class="text-center">Votes</th>
          <th class="text-center">Détail</th>
        </tr>
      </thead>
      <tbody class="table-hover">
        <?php
        foreach ($results as $ligne) {
          echo("<tr>");
          echo("<td class='text-left'>".$ligne['Titre']."</td>");
          echo("<td class='text-center'>".$ligne['Année']."</td>");
          echo("<td class='text-center'>".$ligne['Score']."</td>");
          echo("<td class='text-center'>".$ligne['Votes']."</td>");
          echo("<td class='text-center'><a href='index.php?movieid=".$ligne['MovieID']."'><img src='Web/images/details-icon.png' alt='detail icon'></a></td>");
          echo("</tr>");
        }
        ?>
      </tbody>
    </table>
<a href="#" class="scrollup">Scroll</a>
<?php
  $contenu=ob_get_clean();
  require("Views/layout.php");
?>
