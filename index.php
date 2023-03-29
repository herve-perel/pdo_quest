<?php

require_once 'connec.php';
$pdo = new PDO(DSN, USER, PASS);


$query = 'SELECT * FROM friend';
$statement = $pdo->query($query);
$friends = $statement->fetchAll();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    $query = "INSERT INTO friend (firstname, lastname)
                  VALUES(:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $statement->execute();
   header('location: index.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRIEND</title>
</head>

<body>
    <main>
        <ul>

       <?php foreach  ($friends as $friend) : ?>
        <li><?= $friend['firstname'] . ' ' . $friend['lastname']?></li>

       <?php endforeach ?>
        </ul>
       
        <form action="" method="POST">
            <label for="firstname">Prenom</label>
            <input type="text" name="firstname" id="firstname" required>
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" required>
            <button>Ajouter</button>
        </form>

    </main>
</body>

</html>