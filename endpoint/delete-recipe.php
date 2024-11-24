<?php
include('../conn/conn.php');

if (isset($_GET['recipe'])) {
    $recipeID = $_GET['recipe'];

    $stmt = $conn->prepare("SELECT `recipe_image` FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    $stmt->execute([$recipeID]);
    $row = $stmt->fetch();

    $recipeImage = $row['recipe_image'];

    $stmt = $conn->prepare("DELETE FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    $stmt->execute([$recipeID]);

    if (!empty($recipeImage)) {
        $imagePath = "../uploads/" . $recipeImage;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    echo "<script>
    alert('Deleted Successfully'); 
    window.location.href = 'http://localhost/my-food-recipe/index.php#food';
    </script>";
    exit();
}
?>

