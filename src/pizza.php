<?php
class Pizza
{
    private $id;
    private $name;
    private $price;
    private $url_img;

    public function __construct($id, $name, $url_img, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url_img = $url_img;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrlImg()
    {
        return $this->url_img;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setUrlImg($url_img)
    {
        $this->url_img = $url_img;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

function getAllPizza()
{
    $servername = "localhost";
    $username = "root";
    $bdname = "pizza";
    $sql_pizza_all = "SELECT DESIGNPIZZ, NROPIZZ, URL_IMAGE, TARIFPIZZ FROM pizza";
    $pizzaList = [];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$bdname", $username);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql_pizza_all);
        $stmt->execute();
        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            $pizza = new Pizza($row['NROPIZZ'], $row['DESIGNPIZZ'], $row['URL_IMAGE'], $row['TARIFPIZZ']);
            array_push($pizzaList, $pizza);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $pizzaList;
}

function addPizza($name, $url_img, $price)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizza";
    $sql_pizza_all = "INSERT INTO pizza (DESIGNPIZZ, URL_IMAGE, TARIFPIZZ) VALUES (:name, :url_img, :price)";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql_pizza_all);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':url_img', $url_img);
        $stmt->bindParam(':price', $price);
        $stmt->execute();
        echo "Nouvelle pizza ajoutée avec succès!";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

function modifPizza($id, $name, $url_img)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizza";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE pizza SET DESIGNPIZZ = :name, URL_IMAGE = :url_img WHERE NROPIZZ = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':url_img', $url_img);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "Pizza modifiée avec succès!";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}


function deletePizza($id)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizza";
    $sql = "DELETE FROM pizza WHERE NROPIZZ = :id";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo "Pizza supprimée avec succès!";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

}