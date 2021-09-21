<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['cin']) && !empty($_POST['cin'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['nbHeures']) && !empty($_POST['nbHeures'])
    && isset($_POST['tarifHoraire']) && !empty($_POST['tarifHoraire'])){
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $cin = strip_tags($_POST['cin']);
        $nom = strip_tags($_POST['nom']);
        $prenom = strip_tags($_POST['prenom']);
        $nbHeures = strip_tags($_POST['nbHeures']);
        $tarifHoraire = strip_tags($_POST['tarifHoraire']);

        $sql = 'INSERT INTO `inscrit` (`cin`, `nom`, `prenom`,`nbHeures`,`tarifHoraire`) VALUES (:cin, :nom, :prenom,:nbHeures,:tarifHoraire);';

        $query = $db->prepare($sql);

        $query->bindValue(':cin', $cin, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue(':nbHeures', $nbHeures, PDO::PARAM_INT);
        $query->bindValue(':tarifHoraire',$tarifHoraire, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Produit ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
               <!-- Formulaire -->
             <legend> 
                <fieldset ><h2>Inscription</h2>
 
                   <form method="POST" action="">
                    <input type="number" name="cin" placeholder="entrer cin..."> <br>  <br>                                                                                                                         <input type="number" name="cin" placeholder="entrer cin..."> <br>  <br> 
                     <input type="text" name="nom" placeholder="entrer nom..." >  <br>   <br> 
                     <input type="text" name="prenom" placeholder="entrer prenom..." >  <br>  <br> 
                     <input type="number" name="nbHeures" placeholder="entrer nbHeures ..." > <br>  <br> 
                     <input type="number" name="tarifHoraire" placeholder="entrer tarifHoraire ..." > <br>  <br> 
                     <button name="submit" type="submit"> Submit</button>
                     <button type="reset"> annuler</button>
                   </form>

                 </fieldset>
              </legend>

           </section>
        </div>
    </main>
</body>
</html>