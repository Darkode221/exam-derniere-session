<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Handling</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">       
</head>
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

@media (max-width: 600px) {
  form {
    width: 90%;
  }
}
</style>

<body>
    <nav>
        <ul>
        <ul>
        <li><a href="Acceuil.php">Page d'acceuil</a></li>
            <li><a href="Ajouter.php">Ajouter un nouveau étudiant</a></li>
            <li><a href="liste.php">Liste des étudiants</a></li>
            <li><a href="supprimer.php">Supprimer un étudiant</a></li>
            <li><a href="modifier.php">Modifier un étudiant</a></li>
            
        </ul>
            
        </ul>
    </nav>

    <form action="recherche.php" method="post">
        <h1>Recherche d'étudiant</h1><br>

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

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                echo "<h1>Résultats de la recherche :</h1>";
                echo "<ul>";
                foreach ($result as $row) {
                    echo "<li>Nom: " . $row['nom_etudiant'] . "</li>";
                    echo "<li>Prénom: " . $row['prenom_etudiant'] . "</li>";
                    echo "<li>Adresse: " . $row['adresse_etudiant'] . "</li>";
                    echo "<li>Age: " . $row['age_etudiant'] . "</li>";
                    echo "<li>Statut: " . $row['statu_etudiant'] . "</li>";
                    echo "<br>";
                }
                echo "</ul>";
            } else {
                echo "<h1>Aucun étudiant trouvé.</h1>";
            }
        }
        ?>
    </form>
</body>
</html>

body {
    font-family: 'Nunito Sans', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #F8F9FE;
  }
  
  h1 {
    text-align: center;
    text-transform: uppercase;
    text-shadow: 0px 0px 3px teal;
    font-size: 28px;
    color: black;
    background-color: beige;
    padding: 20px;
    border: 20px;
  }

#p1{
    text-align: start;
}