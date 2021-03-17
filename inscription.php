<?php
    
    try
        {
        // On se connecte à MySQL
            $bdd = new PDO('mysql:host=localhost;dbname=database;charset=utf8', 'root', 'root');
        }
        catch(Exception $e)
                    {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
        }


        // si la variable "$_POST" contient des infos alors on les traites

        if (isset($_POST['inscription']))
        {

            $id = htmlspecialchars($_POST['identifiant']);
            $mdp = sha1($_POST['mdp']);
            $confirm = sha1($_POST['confirm']);

            if(!empty($_POST['identifiant']) && !empty($_POST['mdp']) && !empty($_POST['confirm']))
            {
   
                $idtaille = strlen($id);

                if($id <= 255)
                {
                    if($mdp == $confirm)
                    {
                        $requete = $bdd->prepare('INSERT INTO membre(identifiant, mdp) VALUES(?,?)');
                        $requete->execute(array($id, $mdp));
                        
                        header('Location: contact.php');



                    }
                    else {
                        $erreur = "Attention, vos mots de passe ne correspondent pas !";
                    }

                }
                else {
                    $erreur = "Attention, votre identifiant ne doit pas dépasser 255 caracètres !";
                }

            }
            else {
                $erreur = "Tous les champs doivent-être complétés !";

            }
        }
?>



<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    </head>
    <body>
 
    <div class= "titre" style="text-align: center" . style= "margin: 100px;"><h1 >Inscription</h1> </div>
    </br></br></br>


<div class = "container">
    <div class = "row">

            </br>

    
        <form action="inscription.php" method="POST">
            <div class="col-md-6 offset-3">
                <label class="form-label">Identifiant</label>
                <input type="text" class="form-control" name="identifiant" value = "<?php if(isset($id)) {echo $id;} ?>" >
               
            </div> 

            <br>
            
            <div class="col-md-6 offset-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mdp">
            </div>

            <br>

            <div class="col-md-6 offset-3">
                <label class="form-label">Confirmez mot de passe</label>
                <input type="password" class="form-control" name="confirm">
            </div>

            <br>

          
            
            </br></br>
            
            <button type="submit" class="btn btn-primary col-md-6 offset-3" name="inscription">Je m'inscris</button>
        </form> 
    </div>
</div>

    </br></br>
    
<?php
    if(isset($erreur))
    {
        echo '<font color = "red" > ' .'<center> '. $erreur ."</center" ."</font>";
        
    }
?>



    </body>
</html>






