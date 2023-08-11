<?php 
    session_start();
    include 'views/includes/header.php'; 

    require 'params.php';   
            
             // On récupere les données de l'utilisateur
            $req = $conn->prepare('SELECT * FROM membres ');
            $req->execute(array($_SESSION['prenom']));
            $data = $req->fetch();
            // si la session existe pas soit si l'on est pas connecté on redirige
            if(!isset($_SESSION['prenom'])){
                header('login.php');
                die();
            }
            
?>
                
                <div class="col mt-4">
                    <p class="text-left">Cette application web vous permettras : </p>
                    <p class="text-center">D'inscrire un utilisateur & de se connecter</p>
                    <p class="text-center">Ajout des produits dans votre magasin </p>
                    <p class="text-center">Voir la liste des produits</p>
                    <p class="text-center">Voir la liste des produits en stock</p>
                    <p class="text-monospace">Merci de votre visite</p>
                </div>

            </div>
        </div>
    
<?php include 'views/includes/footer.php'; ?>