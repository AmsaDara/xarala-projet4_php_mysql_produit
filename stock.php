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
            $sql  = 'SELECT `id_produit`, `nom_produit`, `quantite`, `produit_vendu`, (`quantite` - `produit_vendu`) AS stock  FROM `produit`';
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
        
        <table class="table table-striped table-hover table-bordered border-success caption-top">
        <caption class="a1">Liste De Produit En Stock</caption>
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nom Produit</th>
            <th scope="col">Nombre De Stock</th>
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
            <td><?= $appointment->stock ?></td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
        </table>

    </div>

    </div>
    </div>
    
    <?php include 'views/includes/footer.php' ?>