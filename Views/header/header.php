<nav>
	<ul>
		<li><a href="index.php">Accueil</a></li>
		<?php if(isset($_SESSION['login'])){
						echo("<li><a href='index.php?action=deconnexion'>Déconnexion</a></li>");
					}else{
						echo("<li><a href='index.php?action=connexion'>Connexion</a></li>");
						echo("<li><a href='index.php?action=inscription'>Inscription</a></li>");
					}?>
	</ul>
</nav>
<?php
	/* Affichage de l'image e profil */
	if (isset($_SESSION['login'])){
		echo("<div class='session_info'>");
		if($cm->hasImage($_SESSION['login'], $_SESSION['password'])){
			echo "<img src='Web/images/".$_SESSION['login']."' alt='Img User'>";
		} else {
			echo "<img src='Web/images/default.jpeg' alt='Img User default'>";
		}
		echo("<span>".$_SESSION['login']."</span>");
		echo("</div>");
	}
?>
