<?php
    try
    {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=cv;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }

    if (isset($_POST['envoyer']))
    {
        $nomUser = htmlspecialchars($_POST['idmess']);
        $messageUser = htmlspecialchars($_POST['mess']);

        // empty = Si les champs ne sont pas vides
        if(!empty($nomUser) && !empty($messageUser))
        {
            $requete = $bdd->prepare('INSERT INTO messagerie(identifiants, mess) VALUES(?,?)');
            $requete->execute(array($nomUser, $messageUser));
            $erreur = "Votre message a bien été envoyé ! <a href=\"index.php\">Cliquez ici pour revenir à notre page d'accueil";
        }
            else 
            {
                $erreur =  "Tous les champs doivent-être complétés !";
            }
    }
?>


<html>
    <head>
        <title>Message</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


    </head>
    <body>
        <div class= "titre" style="text-align: center;"><h1 >Bravo. Vous êtes bien connecté !</h1> </div>
        </br></br>

        <div class= "titre" style="text-align: center;"><h4 >Vous pouvez à présent laisser votre message!</h'> </div>
        </br></br></br>
        </br></br></br>

    

<div class = "container">
    <div class = "row">

            </br>

    
        <form action="message.php" method="POST">
            <div class="col-md-6 offset-3">
                <label class="form-label">Votre nom</label>
                <input type="text" class="form-control" name="idmess" >
               
            </div> 

            <br>
            <div class="col-md-6 offset-3">
                <label class="form-label">Votre message</label>
                <input type="text" class="form-control" name="mess" >
               
            </div> 
            

            <br>        
            </br></br>
            
            <button type="submit" class="btn btn-primary col-md-6 offset-3" name="envoyer">Envoyer.</button>
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







