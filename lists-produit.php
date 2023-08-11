<?php
    session_start();

    require 'params.php';   
            
             // On récupere les données de l'utilisateur
            $req = $conn->prepare('SELECT * FROM membres ');
            $req->execute(array($_SESSION['prenom']));
            $data = $req->fetch();
            // si la session existe pas soit si l'on est pas connecté on redirige
            if(!isset($_SESSION['prenom'])){
                header('Location:login.php');
                die();
            }
            
            // variable pour afficher les données souhaité d'une table
            $sql  = 'SELECT `id_produit`, `nom_produit`, `quantite`, `produit_vendu` FROM `produit`';
            // Envoie de la requête vers la base de données
            $sth = $conn->query($sql);
            $appointmentsList = [];
            if ($sth instanceOf PDOStatement) {
            // Collection des données dans un tableau associatif (FETCH_ASSOC)
            $appointmentsList = $sth->fetchAll(PDO::FETCH_OBJ);
            }
    include 'views/includes/header.php';
?>



        
        <div class="col mt-4">
        
        <table class="table table-striped table-hover table-bordered border-primary caption-top">
            <caption>Liste De Produit</caption>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nom Produit</th>
                <th scope="col">Quantité</th>
                <th scope="col">Produit Vendu</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (count($appointmentsList) > 0) {
                    foreach ($appointmentsList AS $key => $appointment){
                ?>
                <tr>
                <th scope="row"><?= $appointment->id_produit ?></th>
                <td><?= $appointment->nom_produit ?></td>
                <td><?= $appointment->quantite ?></td>
                <td><?= $appointment->produit_vendu ?></td>
                <td style="background-color: rgb(113, 109, 109);">
                    <div class="juo">
                        <a href="#">
                            <ion-icon class="ion1" name="create-outline"></ion-icon>
                        </a>
                        <a href="#">
                            <ion-icon class="ion2" name="trash-outline"></ion-icon>
                        </a></div>
                </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
        
        <div class="d-grid gap-2 col-6 mx-auto">
            <a href="ajout-produit.php">
                <button class="btn btn-primary" type="button">Ajouter Un Produit</button>
            </a>
        </div> <br>

    </div>

    </div>
    </div>
    
    <?php include 'views/includes/footer.php'; ?>