<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=magasin', 'root', '');

if(isset($_POST['forminscription'])) {
   $prenom = htmlspecialchars($_POST['prenom']);
   $nom = htmlspecialchars($_POST['nom']);
   $utilisateur = htmlspecialchars($_POST['utilisateur']);
//    $utilisateur2 = htmlspecialchars($_POST['utilisateur2']);
   $password = sha1($_POST['password']);
   $confirmPassword = sha1($_POST['confirmPassword']);
   if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['utilisateur']) AND !empty($_POST['password']) AND !empty($_POST['confirmPassword'])) {
      $prenomlength = strlen($prenom);
      if($prenomlength <= 255) {
         if($utilisateur == $prenom) {
            if(filter_var($utilisateur)) {
               $requtilisateur = $bdd->prepare("SELECT * FROM membres WHERE utilisateur = ?");
               $requtilisateur->execute(array($utilisateur));
               $utilisateurexist = $requtilisateur->rowCount();
               if($utilisateurexist == 0) {
                  if($password == $confirmPassword) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(`prenom`, `nom`, `utilisateur`, `motdepasse`) VALUES(?, ?, ?, ?)");
                     $insertmbr->execute(array($prenom, $nom, $utilisateur, $password));
                     $erreur = "Votre compte a bien été créé ! <a href=\"login.php\">Me connecter</a>";
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse utilisateur déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse utilisateur n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses utilisateur ne correspondent pas !";
         }
      } else {
         $erreur = "Votre prenom ne doit pas dépasser 255 caractères !";
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
    <caption><h2 class="text-center">Enregistrer un utilisateur</h2></caption>
    <div class="d-grid gap-2 col-6 mx-auto mb-3">
        <label for="prenom" class="form-label">PréNom</label>
        <input type="text" class="form-control" placeholder="Mettez votre prenom" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>"/>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" placeholder="Mettez votre nom" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>"/>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mb-3">
        <label for="utilisateur" class="form-label">Login</label>
        <input type="text" class="form-control" placeholder="Entrée un nom d'utilisateur" id="utilisateur" name="utilisateur" value="<?php if(isset($utilisateur)) { echo $utilisateur; } ?>"/>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" placeholder="Mettez Un Mot De Passe" id="password" name="password" value="<?php if(isset($password)) { echo $password; } ?>"/>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mb-3">
        <label for="confirmPassword" class="form-label">Confirmer Password</label>
        <input type="password" class="form-control" placeholder="Remettez Le Mot De Passe" id="confirmPassword" name="confirmPassword" value="<?php if(isset($confirmPassword)) { echo $confirmPassword; } ?>"/>
    </div>
    <!-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->
    <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" name="forminscription" type="submit">S'inscrire</button>
    </div> <br>
    
    </form>
    
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
