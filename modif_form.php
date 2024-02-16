<?php
    session_start();
    include_once("./src/head.php");
    include_once("./src/pizza.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namePizza = htmlspecialchars($_POST["name_pizza"]);
        $urlImg = htmlspecialchars($_POST["url_img"]);
        $id = htmlspecialchars($_POST["id"]); // Récupération de l'ID depuis le champ caché
        modifPizza($id, $namePizza, $urlImg);
        echo "Pizza mise à jour avec succès.";
    }

    $pizzaList = getAllPizza();
    $pizzaToUpdate = null;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        foreach ($pizzaList as $pizza) {
            if ($pizza->getId() == $id) {
                $pizzaToUpdate = $pizza;
                break;
            }
        }
    }
?>

<body>
    <header>
        <h1>Pipipipizza!</h1>
    </header>
    <main>
        <?php if ($pizzaToUpdate): ?>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $pizzaToUpdate->getId() ?>">
            <label for="name_pizza">Nom de la pizza:</label>
            <input type="text" name="name_pizza" id="name_pizza" value="<?= $pizzaToUpdate->getName() ?>" required>
            <label for="url_img">URL de l'image:</label>
            <input type="text" name="url_img" id="url_img" value="<?= $pizzaToUpdate->getUrlImg() ?>" required>
            <input class="button" type="submit" value="Modifier">
        </form>
        <?php else: ?>
        <p>Pizza non trouvée.</p>
        <?php endif; ?>
        </span><a class="button" href="./index.php">Retour</a><span class="pln">
    </main>
    <footer>
        <p></p>
    </footer>
</body>