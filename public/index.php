<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de progression batterie</title>
</head>
<body>
    <h1>Suivi de progression à la batterie.</h1>
    <!-- Acces à la base de données -->
    <?php
    require "../config.php";
    try {
            $pdo=new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
            if (isset($_POST["titre"])) {
                $stmt = $pdo->prepare("INSERT INTO morceaux (titre, artiste, statut) VALUES (?, ?, ?)");
                $stmt->execute([$_POST["titre"], $_POST["artiste"], $_POST["statut"]]);
                header("Location: index.php");
                exit;
            }
            $stmt=$pdo->prepare("SELECT * FROM morceaux");
            $stmt->execute();
            $morceaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        echo("Erreur : {$e->getMessage()}");
    }
    ?>
    <!-- Affichage de la liste en base données -->
    <ul>
        <?php
            foreach ($morceaux as $morceau) {
                echo("<li>{$morceau["titre"]} - {$morceau["artiste"]}</li>");
            }
        ?>
    </ul>
    <!-- Le Formulaire -->
    <form action="index.php" method="post">
        <div>
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre">
        </div>
        <div>
            <label for="artiste">Artiste</label>
            <input type="text" name="artiste" id="artiste">
        </div>
        <div>
            <label for="statut">Statut</label>
            <select name="statut" id="statut">
                <option value="à travailler">à travailler</option>
                <option value="en cours">en cours</option>
                <option value="finalisé">finalisé</option>
            </select>
        </div>
        <button>Envoyer</button>
    </form>
</body>
</html>