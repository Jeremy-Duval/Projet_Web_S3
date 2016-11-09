<?php
  include_once("Model.php"); //la fonction doit être incluse une seule fois
  class CommentManager extends Model{

   	public function commentRegister($movieid, $login, $comment){
     	  $query=$this->executerRequete("INSERT INTO Comments(MovieID, Login, Comment) VALUES ('".$movieid."','".$login."','".$comment. "');");
        // $query=$this->executerRequete("INSERT INTO Comments(CommentID, MovieID, Login, Comment) VALUES (?,?,?,?);", array($numCom,$movieid,$login,$comment));
   	    //$query->fetchAll(PDO::FETCH_ASSOC);
   	}

    //Récupère l'id des commentaires
    public function maxCommentID($movieid){
        $query=$this->executerRequete("SELECT CommentID FROM Comments WHERE MovieID = '".$movieid."';");
        $data=$query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //Récupère les commentaires
    public function getComments($movieid){
          $query = $this->executerRequete("SELECT * FROM Comments WHERE MovieID = '".$movieid."';");
          $data = $query->fetchAll(PDO::FETCH_ASSOC);//on récupère un tableau de données
          //on libère le curseur
          $query->closeCursor();

          return $data;
    }

  }

?>
