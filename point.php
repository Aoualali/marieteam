<?php



        require_once'inc/functions.php';
        session();
        require_once "inc/conxbdd.inc.php";
        $pdo = connexpdo("marieteam","donbdd");
       
       
        $statement = "SELECT COUNT(reservation.id_client)>5 as nombre,client.id_client,mail FROM client,reservation where client.id_client = reservation.id_client GROUP by reservation.id_client";
        $req = $pdo->query($statement);
        $req->execute();
        if(!$req){
          echo "aucun client";
        }
        else
        {
          
          while ($donnees = $req->fetch()) {

            echo "<br>id_client: ". $donnees['id_client']."/nombre de reservation superieur a cinq: ". $donnees['nombre'];
                    if ($donnees['nombre']==1) {
                      
                                    $req = $pdo ->prepare ("UPDATE client SET point = 5 WHERE client.id_client = :id");
                           
                                    $req->execute(
                                        array
                                        (

                                        ':id'=>$donnees['id_client']
                                    
                                        )
                                    );
                        mail($donnees['mail'],"voici vos point de fidelite", "5 euros");
                    }

  
          }
        }

