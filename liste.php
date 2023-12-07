<!DOCTYPE html>
<html lang="en">
<head>
<title>PHP Form Handling</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
body {
  font-family: 'Nunito Sans', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #F8F9FE;
}

h1 {
  margin-top: 20px;
  margin-bottom: 30px;
  font-size: 28px;
  color: #FF3333; /* Rouge */
  text-align: center;
}

.container {
  background-color: #FFFFFF;
  padding: 20px;
  width: 80%;
  margin: 0 auto;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #CCCCCC;
  border-radius: 4px;
}

input[type="submit"] {
  background-color: #FF3333;
  color: #FFFFFF;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
  border: 1px solid #CCCCCC;
  border-radius: 4px;
}

table th,
table td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #CCCCCC;
}

table th {
  background-color: #00BFFF;
  color: #FFFFFF;
}

@media (max-width: 600px) {
  .container {
    width: 90%;
  }
}


</style>
</head>

<body>
<nav>
        <ul>
        <li><a href="Acceuil.php">Page d'acceuil</a></li>
            <li><a href="ajouter.php">Ajouter un nouveau étudiant</a></li>
            <li><a href="recherche.php">Rechercher un étudiant</a></li>
            <li><a href="supprimer.php">Supprimer un étudiant</a></li>
            <li><a href="modifier.php">Modifier un étudiant</a></li>
            
        </ul>
    </nav>

    <h1>Liste des étudiants</h1>

    <form action="liste.php" method="post">
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=student","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM etudiant";
        $stmt = $pdo->query($sql);
        $rowCount = $stmt->rowCount();

        echo "<hr>";
        echo "<h1><b>La liste des :</b> $rowCount étudiant(s) inscrit(s)</h1>";

        echo "<ul>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>";
            echo "<input type='radio' name='etudiant_id' value='" . $row['etudiant_id'] . "'>";
            echo $row["nom_etudiant"];
            echo "</li>";
        }
        echo "</ul>";

        echo "<button type='submit'>Afficher les détails</button>";
        echo "<button type='submit' name='removeAll'>Remove all</button>";

        if (isset($_POST['etudiant_id'])) {
            $selectedId = $_POST['etudiant_id'];
            $sql = "SELECT * FROM etudiant WHERE etudiant_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $selectedId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo "<h2>Détails de l'étudiant sélectionné :</h2>";
                echo "<dl>";
                echo "<dd>Identifiant : " . $row["etudiant_id"] . "</dd>";
                echo "<dd>Nom : " . $row["nom_etudiant"] . "</dd>";
                echo "<dd>Prénom : " . $row["prenom_etudiant"] . "</dd>";
                echo "<dd>Adresse : " . $row["adresse_etudiant"] . "</dd>";
                echo "<dd>Âge : " . $row["age_etudiant"] . " ans</dd>";
                echo "<dd>Statut : " . $row["statu_etudiant"] . "</dd>";
                echo "</dl>";
            } else {
                echo "<h2>Aucun étudiant sélectionné</h2>";
            }
        }

        if (isset($_POST['removeAll'])) {
            $sql = "DELETE FROM etudiant";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            echo "<h2>Tous les étudiants ont été supprimés avec succès.</h2>";
        }
        ?>
    </form>

</body>
