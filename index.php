<?php
    session_start();
    include_once("./src/head.php");
    include_once("./src/pizza.php");

    if (isset($_GET['id'])) {
        $pizzaId = $_GET['id'];
        deletePizza($pizzaId);
        exit;
    }
?>
<body>
    <header>
        <h1>Pipipipizza!</h1>
    </header>
    <main>
        <a class="button" href="./add_form.php">Ajouter une pizza</a>
        <ul class="primary-grid">
            <?php
                $pizzaList = getAllPizza();

                foreach ($pizzaList as $pizza) {
                    echo "
                        <li><img src=\"".$pizza->getUrlImg()."\" alt=\"".$pizza->getName()."\"></li>
                        <li><h2>".$pizza->getName()."</h2>
                        <p>".$pizza->getPrice()."€</p>
                        <span class=\"pln\"><!-- Default Button -->
                        </span><a class=\"button\" href=\"modif_form.php?id=".$pizza->getId()."\" class=\"pln\">Modifier</a><span class=\"pln\">
                        <span class=\"pln\"><!-- Default Button -->
                        </span><a href='?id=".$pizza->getId()."' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette pizza ?\");'>Supprimer</a>
                        </li>
                    ";
                }
            ?>
        </ul>
    </main>
    <footer>
        <p></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>