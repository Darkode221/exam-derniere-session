<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Form Handling</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">      
    <style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
  background-color: #f7f7f7;
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  text-align: center;
}

.container {
  max-width: 600px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

}
strong{
  text-align: center;
}

h1 {
  color: #ff3333;
  text-align: center;
  margin-bottom: 20px;
}

form {
  margin-top: 20px;
}

form label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}

form input[type="text"],
form select {
  width: 100%;
  max-width: 400px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  
}

form input[type="submit"] {
  background-color: #ff3333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  
}

form input[type="submit"]:hover {
  background-color: #cc0000;
}

.error-message {
  color: #cc0000;
  margin-top: 10px;
}


</style>
</head>

    <body>

        <nav>
        <ul>
        <ul>
            <li><a href="Acceuil.php">Page d'acceuil</a></li>
            <li><a href="liste.php">Liste des étudiants</a></li>
            <li><a href="recherche.php">Rechercher un étudiant</a></li>
            <li><a href="supprimer.php">Supprimer un étudiant</a></li>
            <li><a href="modifier.php">Modifier un étudiant</a></li>
            
        </ul>
        </ul>
        </nav>

        <form action = "Ajouter.php" method = "get">

            <h1>Ajouter un etudiant </h1>

            <strong>Nom</strong><br>
            <input type = "text" name = "nom" placeholder="nom"><br><br>

            <strong>Prenom</strong><br>
            <input type = "text" name = "prenom" placeholder="prenom"><br><br>

            <strong>adresse</strong><br>
            <input type = "text" name = "adresse" placeholder="adresse"><br><br>

            <strong>age</strong><br>
            <input type = "text" name = "age" placeholder="age"><br><br>

            <strong>Statut</strong><br>
            <input type = "text" name = "statu" placeholder="statu"><br><br>

            <input type = "submit" class="" name="sm" value = "Ajouter">

            
            <?php

                if(isset($_GET["sm"]))
                {
                    $pdo = new PDO("mysql:host=localhost;dbname=student", "root", "");
                    $pdo -> setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "INSERT INTO etudiant (nom_etudiant, prenom_etudiant, adresse_etudiant, age_etudiant, statu_etudiant)
                            values(:p_nom, :p_prenom, :p_adresse,:p_age, :p_statu)";
                    
                    $stmt = $pdo->prepare($sql);
                    $nom = $_GET['nom'];
                    $prenom = $_GET['prenom'];
                    $adresse = $_GET['adresse'];
                    $age = $_GET['age'];
                    $statu = $_GET['statu'];

                    $stmt->bindParam(':p_nom',$nom);
                    $stmt->bindParam(':p_prenom',$prenom);
                    $stmt->bindParam(':p_adresse',$adresse);
                    $stmt->bindParam(':p_age',$age);
                    $stmt->bindParam(':p_statu',$statu);

                    $stmt->execute();
                    if ($stmt->rowCount() >0){
                        echo "<h1>Etudiant enregistré .</h1>";
                    }else{
                        echo "<h1>Erreur.</br>L'etudiant n'a pas ete ajouté.</h1>";
                    }
                }

            ?>
            
            
         </form>

    </body>

</html>