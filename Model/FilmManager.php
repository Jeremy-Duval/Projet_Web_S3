<?php
  include_once("Model.php"); //la fonction doit être incluse une seule fois
  class FilmManager extends Model{



   	//sert à récupérer la liste des films
   	public function getFilms(){

   	        $query = $this->executerRequete('SELECT * FROM Movie'); // requête SQL
   	        $data = $query->fetchAll(PDO::FETCH_ASSOC);//on récupère un tableau de données

   	        //on libère le curseur
   	    	$query->closeCursor();

   	    	return $data;

   	}

   	//sert à renvoyer les castings du film en fonction d'un movieID
   	public function getCasting($movieid){
   	    $query=$this->executerRequete('SELECT c.ordinal as Ordinal, a.nom as Nom
   	                                        from Casting c join Actor a on c.ActorID=a.ActorID
   	                                        where c.MovieID ='.$movieid.' ORDER BY c.Ordinal asc',array(1));
   	    $data=$query->fetchAll(PDO::FETCH_ASSOC);

   	    return $data;
   	}



   	//sert à renvoyer les détails du film en fonction d'un movieID
   	public function getFilmDetails($movieid){
   	    $query=$this->executerRequete('SELECT * from Movie where MovieID ='.$movieid,array(1));
   	    $data=$query->fetch();

   	    return $data;
   	}


    //Verifie si l'utilisateur a voté
    public function checkVote($movieid,$userid){

     $query=$this->executerRequete('SELECT * from Vote where MovieID ='.$movieid.' and UserID='.$userid,array(1));
     $data=$query->fetch();

     return $data;
   }

  //Ajoute 1 au nombres de votes
  public function updateVote($movieid,$userid){
    $query=$this->executerRequete('update Movie set  Votes=Votes+1 where MovieID ='.$movieid);
    $query=$this->executerRequete('insert into Vote values ('.$movieid.','.$userid.')');
  }
}

?>
