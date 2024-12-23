<?php
include('../conn/conn.php');

$recipeID = $_POST['tbl_recipe_id'];
$updateRecipeName = $_POST['recipe_name'];
$updateRecipeCategory = $_POST['tbl_category_id'];
$updateRecipeIngredients = $_POST['recipe_ingredients'];
$updateRecipeProcedure = $_POST['recipe_procedure'];

if ($_FILES['recipe_image']['tmp_name'] != "") {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES['recipe_image']['name']);
    move_uploaded_file($_FILES['recipe_image']['tmp_name'], $targetFile);

    $stmt = $conn->prepare("UPDATE tbl_recipe SET recipe_name = ?, tbl_category_id = ?, recipe_image = ?, recipe_ingredients = ?, recipe_procedure = ? WHERE tbl_recipe_id = ?");
    $stmt->execute([$updateRecipeName, $updateRecipeCategory, $_FILES['recipe_image']['name'], $updateRecipeIngredients, $updateRecipeProcedure, $recipeID]);
} else {
    $stmt = $conn->prepare("UPDATE tbl_recipe SET recipe_name = ?, tbl_category_id = ?, recipe_ingredients = ?, recipe_procedure = ? WHERE tbl_recipe_id = ?");
    $stmt->execute([$updateRecipeName, $updateRecipeCategory, $updateRecipeIngredients, $updateRecipeProcedure, $recipeID]);
}

echo "<script>
    alert('Updated Successfully'); 
    window.location.href = 'http://localhost/my-food-recipe/index.php#food';
    </script>";
exit();
?>
