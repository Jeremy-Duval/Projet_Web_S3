<?php
  include_once("Model.php"); //la fonction doit être incluse une seule fois
  class ConnexionManager extends Model{

    //Vérifie si le login existe
   	public function checkLogin($login){
     	  $query=$this->executerRequete("SELECT Login FROM Utilisateur where Login='".$login."';",array(1));
   	    $data=$query->fetchAll(PDO::FETCH_ASSOC);
   	    return $data;
   	}

    //Vérifie si le login et mot de pass existe
    public function checkConnexion($login, $password){
     	  $query=$this->executerRequete("SELECT Login, Pass FROM Utilisateur where Login='".$login."' AND Pass='".$password."';",array(1));
   	    $data=$query->fetchAll(PDO::FETCH_ASSOC);

   	    return $data;
   	}

    //Récupère l'id de l'utilisateur
    public function getUserid($login,$password){
      $query=$this->executerRequete("SELECT UserID FROM Utilisateur where Login='".$login."' AND Pass='".$password."';",array(1));
      $data=$query->fetchColumn();
      return $data;
    }

    //Vérifie si l'utilisateur a une image
    public function hasImage($login,$password){
      $query=$this->executerRequete("SELECT image FROM Utilisateur where Login='".$login."' AND Pass='".$password."';",array(1));
      $data=$query->fetchColumn();
      return $data;
    }

    //Ajoute un nouvel utilisateur
    public function inscription($login,$password,$nom,$mail,$hasImg){
      $query=$this->executerRequete("SELECT UserID FROM Utilisateur;");
      $data=$query->fetchAll(PDO::FETCH_ASSOC);
      $userid = count($data)+1;
      $query=$this->executerRequete("INSERT INTO Utilisateur VALUES ('".$userid."','".$login."','".$password."','".$nom."','".$mail."','".$hasImg."')",array(1));
    }

  }

?>
