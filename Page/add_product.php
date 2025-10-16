<?php
session_start();
include '../config/dbconfig.php';

// access admins only-----------------------------------------------
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied. must be an admin to view this page.");
}
//------------------------------------------------------------------

//form submission---------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);

    $target_dir = "../assets/img/Products/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<p style='color:red;'>File is not an image.</p>";
    } elseif (!in_array($imageFileType, $allowed_types)) {
        echo "<p style='color:red;'>Only JPG, JPEG, PNG, GIF, and WEBP are allowed.</p>";
    } elseif ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
        echo "<p style='color:red;'>File too large (max 5MB).</p>";
    } elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        
        $sql = "INSERT INTO products (name, description, price, image)
                VALUES ('$name', '$description', '$price', '$image_name')";
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green;'> Product added successfully!</p>";
        } else {
            echo "<p style='color:red;'>Database error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Failed to upload image.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product | Admin</title>
</head>
<body>
    <h2>Add New Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Product Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="3" required></textarea><br><br>

        <label>Price (₱):</label><br>
        <input type="number" name="price" step="0.01" required><br><br>

        <label>Image:</label><br>
        <input type="file" name="image" accept="image/*" required><br><br>

        <button type="submit">Add Product</button>
    </form>

    <br><a href="shop.php">Back to Shop</a>
</body>
</html>
