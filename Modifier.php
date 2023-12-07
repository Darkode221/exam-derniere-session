<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Form Handling</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">      
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
  color: #333333;
}

form {
  background-color: #FFFFFF;
  padding: 20px;
  width: 400px;
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
  background-color: #FF3F34;
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
}

table th,
table td {
  padding: 8px;
  text-align: left;
}

table th {
  background-color: #007BFF;
  color: #FFFFFF;
}

/* Responsive */
@media (max-width: 600px) {
  form {
    width: 90%;
  }
}
</style>
</head>
<body>
    <nav>
        <ul>
        <ul>
        <li><a href="Acceuil.php">Page d'acceuil</a></li>
            <li><a href="Ajouter.php">Ajouter un nouveau étudiant</a></li>
            <li><a href="recherche.php">Rechercher un étudiant</a></li>
            <li><a href="supprimer.php">Supprimer un étudiant</a></li>
            <li><a href="liste.php">Liste des étudiants</a></li>
            
        </ul>
        </ul>
    </nav>

    <form action="modifier.php" method="post">
        <h1>Modification d'un étudiant</h1><br>

        <strong>Nom de l'étudiant :</strong>
        <input type="text" name="nom_etudiant" required><br><br>

        <input type="submit" name="search" value="Rechercher">

        <?php
        if(isset($_POST['search'])){
            $pdo = new PDO("mysql:host=localhost;dbname=student", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $nomEtudiant = $_POST['nom_etudiant'];

            $sql = "SELECT * FROM etudiant WHERE nom_etudiant = :nomEtudiant";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nomEtudiant', $nomEtudiant);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo "<h1>Informations de l'étudiant :</h1>";
                echo "<table>";
                echo "<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Age</th><th>Statut</th></tr>";
                echo "<tr><td>" . $result['nom_etudiant'] . "</td>";
                echo "<td>" . $result['prenom_etudiant'] . "</td>";
                echo "<td>" . $result['adresse_etudiant'] . "</td>";
                echo "<td>" . $result['age_etudiant'] . "</td>";
                echo "<td>" . $result['statu_etudiant'] . "</td></tr>";
                echo "</table>";

                echo "<br>";
                echo "<h1>Modifier les informations de l'étudiant :</h1>";
                echo "<input type='hidden' name='etudiant_id' value='" . $result['etudiant_id'] . "'>";
                echo "<strong>Statut :</strong>";
                echo "<input type='text' name='new_statu_etudiant' value='" . $result['statu_etudiant'] . "'><br><br>";
                echo "<strong>Age :</strong>";
                echo "<input type='text' name='new_age_etudiant' value='" . $result['age_etudiant'] . "'><br><br>";
                echo "<strong>Adresse :</strong>";
                echo "<input type='text' name='new_adresse_etudiant' value='" . $result['adresse_etudiant'] . "'><br><br>";
                echo "<input type='submit' name='update' value='Mettre à jour'>";
            } else {
                echo "<h1>Aucun étudiant trouvé.</h1>";
            }
        }

        if(isset($_POST['update'])){
            $pdo = new PDO("mysql:host=localhost;dbname=student", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $etudiantId = $_POST['etudiant_id'];
            $newStatuEtudiant = $_POST['new_statu_etudiant'];
            $newAgeEtudiant = $_POST['new_age_etudiant'];
            $newAdresseEtudiant = $_POST['new_adresse_etudiant'];

            $sql = "UPDATE etudiant SET statu_etudiant = :statu, age_etudiant = :age, adresse_etudiant = :adresse WHERE etudiant_id = :etudiantId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':statu', $newStatuEtudiant);
            $stmt->bindParam(':age', $newAgeEtudiant);
            $stmt->bindParam(':adresse', $newAdresseEtudiant);
            $stmt->bindParam(':etudiantId', $etudiantId);

            if ($stmt->execute()) {
                echo "<h2>Les informations de l'étudiant ont été mises à jour avec succès.</h2>";
            } else {
                echo "<h2>Erreur lors de la mise à jour des informations de l'étudiant.</h2>";
            }
        }
        ?>
    </form>
</body>
</html>
