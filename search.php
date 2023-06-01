<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $category = $_GET["categorie"];
    $searchTerm = $_GET["search"];

    switch ($category) {
        case "produits":
            header("Location: produits.php?search=" . urlencode($searchTerm));
            exit();
        case "produits-jardinage":
            header("Location: produits-jardinage.php?search=" . urlencode($searchTerm));
            exit();
        case "produits-maison":
            header("Location: produits-maison.php?search=" . urlencode($searchTerm));
            exit();
        case "produits-loisirs":
            header("Location: produits-loisirs.php?search=" . urlencode($searchTerm));
            exit();
        default:

            break;
    }
}

?>