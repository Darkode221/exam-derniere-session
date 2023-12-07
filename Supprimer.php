<!DOCTYPE html>
<html>
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

@media (max-width: 600px) {
  form {
    width: 90%;
  }
}</style>     
</head>
<body>
    <nav>
        <ul>
        <ul>
        <li><a href="Acceuil.php">Page d'acceuil</a></li>
            <li><a href="Ajouter.php">Ajouter un nouveau étudiant</a></li>
            <li><a href="recherche.php">Rechercher un étudiant</a></li>
            <li><a href="liste.php">Liste des étudiants</a></li>
            <li><a href="modifier.php">Modifier un étudiant</a></li>
            
        </ul>
            
        </ul>
    </nav>

    <form action="supprimer.php" method="post">
        <h1>Suppression d'étudiant</h1><br>

        <strong>Nom de l'étudiant :</strong>
        <input type="text" name="nom_etudiant" required><br><br>

        <input type="submit" name="delete" value="Supprimer">

        <?php
        if(isset($_POST['delete'])){
            $pdo = new PDO("mysql:host=localhost;dbname=student", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $nomEtudiant = $_POST['nom_etudiant'];

            $sql = "DELETE FROM etudiant WHERE nom_etudiant = :nomEtudiant";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nomEtudiant', $nomEtudiant);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h1>Etudiant supprimé.</h1>";
            } else {
                echo "<h1>Aucun étudiant supprimé.</h1>";
            }
        }
        ?>
    </form>
</body>
</html>
