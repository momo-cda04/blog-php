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

    if (isset($_POST['connexion']))
    {
        $idCo = htmlspecialchars($_POST['identifiantCo']);
        $mdpCo = sha1($_POST['mdpCo']);

        // empty = Si les champs ne sont pas vides
        if(!empty($idCo) && !empty($mdpCo))
            {
                $reqUser = $bdd->prepare("SELECT * FROM membre WHERE identifiant = ? && mdp = ?");
                $reqUser->execute(array($idCo, $mdpCo));
                $userExist = $reqUser->rowCount();

                if($userExist == 1)
                {
                    header('Location: message.php');

                }
                else 
                {
                    $erreur = "L'identifiant ou le mot de passe est incorrect";
                }
            }
            else 
            {
                $erreur =  "Tous les champs doivent-être complétés !";
            }
    }
?>


<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    </head>
    <body>
        <div class= "titre" style="text-align: center;"><h1 >Contact</h1> </div>
        </br></br>

        <div class= "titre" style="text-align: center;"><h1 >Bravo ! Votre compte a bien été crée !</h1> </div>
        </br></br></br>
        </br></br></br>

    

<div class = "container">
    <div class = "row">

            </br>

    
        <form action="contact.php" method="POST">
            <div class="col-md-6 offset-3">
                <label class="form-label">Identifiant</label>
                <input type="text" class="form-control" name="identifiantCo" value = "<?php if(isset($idCo)) {echo $idCo;} ?>" >
               
            </div> 

            <br>
            
            <div class="col-md-6 offset-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mdpCo">
            </div>

            <br>        
            </br></br>
            
            <button type="submit" class="btn btn-primary col-md-6 offset-3" name="connexion">Se connecter.</button>
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







