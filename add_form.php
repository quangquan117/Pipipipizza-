<?php
    session_start();
    include_once("./src/head.php");
    include_once("./src/pizza.php");
    
    
    if (isset($_POST["submit"])) {
        $target_dir = "./asset/";
        if (isset($_FILES["image_pizza"]) && $_FILES["image_pizza"]["error"] == 0) {
            $target_file = $target_dir.basename($_FILES["image_pizza"]["name"]);
            if(move_uploaded_file($_FILES["image_pizza"]["tmp_name"], $target_file)) {
                echo "Le fichier ". htmlspecialchars(basename($_FILES["image_pizza"]["name"])). " a été téléchargé.";
                addPizza($_POST["name_pizza"], $target_file, $_POST["price_pizza"]);
            } else {
                echo "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
            }
        } else {
            echo "Aucun fichier n'a été soumis ou une erreur est survenue lors du téléchargement.";
        }
    }
?>
<body>
    <header>
        <h1>Pipipipizza!</h1>
    </header>
    <main>
        <form action="add_form.php" method="post" enctype="multipart/form-data">
            Nom de la pizza: <input type="text" name="name_pizza"><br>
            Prix de la pizza: <input type="text" name="price_pizza"><br>
            Sélectionnez une image pour la pizza:
            <input type="file" name="image_pizza">
            <input type="submit" name="submit" value="Ajouter Pizza">
        </form>
        </span><a class="button" href="./index.php">Retour</a><span class="pln">
    </main>
    <footer>
        <p></p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>