<?php 
    session_start();
     try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=magasin;charset=utf8", "root", "");
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
   // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['prenom'])){
        header('Location:login.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM membres WHERE token = ?');
    $req->execute(array($_SESSION['prenom']));
    $data = $req->fetch();
   
    include 'views/includes/header.php';
?>

        
        <div class="col mt-4">
            <img src="assets/image/images.jpg" alt="bienvenue" class="rounded mx-auto d-block" width="70%" height="300px">
        </div>

    </div>
    </div>
    
    <?php include 'views/includes/footer.php'; ?>