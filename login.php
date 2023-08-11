<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=magasin', 'root', '');

if(isset($_POST['formconnexion'])) {
   $utilisateurconnect = htmlspecialchars($_POST['utilisateurconnect']);
   $passwordconnect = sha1($_POST['passwordconnect']);
   if(!empty($utilisateurconnect) AND !empty($passwordconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE utilisateur = ? AND motdepasse = ?");
      $requser->execute(array($utilisateurconnect, $passwordconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['prenom'] = $userinfo['prenom'];
         $_SESSION['nom'] = $userinfo['nom'];
         $_SESSION['utilisateur'] = $userinfo['utilisateur'];
         header("Location: lists-produit.php?prenom=".$_SESSION['prenom']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Application Magasinier</title>
</head>
<body>
    <div>
    
        <form method="post" action="">
        <div class="d-grid gap-2 col-6 mx-auto mb-3">
            <label for="utilisateurconnect" class="form-label">Nom D'utilisateur</label>
            <input type="text" name="utilisateurconnect" lass="form-control">
        </div>
        <div class="d-grid gap-2 col-6 mx-auto mb-3">
            <label for="passwordconnect" class="form-label">Mot De Passe</label>
            <input type="password" name="passwordconnect" class="form-control">
        </div>
        
        <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" name="formconnexion" type="submit">Connexion</button>
        </div> <br>
        
        </form>
        
       
    
    </div>
    <div style="text-align: center;color: #0d6efd">
        <h2>Si vous n'avez pas de compte, merci de cliquez <a href="inscription.php">ICI</a></h2>
    </div>
    <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
    ?>
    
    <footer>
        <h4>Copyrigth &copy; Elhadji Samba SY | Xarala 2023</h4>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
