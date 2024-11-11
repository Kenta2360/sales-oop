<?php

require "../classes/User.php";

$id = $_GET['id'];
$product_obj = new User;
$product = $product_obj->getProduct($id);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand navbar-white bg-ehite" style="margin-bottom: 80px;">
    <div class="container">
      <a href="dashboard.php" class="navbar-brand">
        <i class="fa-solid fa-house"></i>
      </a>
      <div class="navbar-nav">
        <form action="../actions/logout.php" method="post" class="d-flex ms-2">
          <button type="submit" class="text-danger bg-transparent border-0">Log out</button>
        </form>
      </div>
    </div>
  </nav>
  
  <main class="row justify-content-center gx-0">
    <div class="col-4">
      <h2 class="text-center mb-4 text-uppercase">Edit Product</h2>

      <form action="../actions/edit-product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <div class="mb-3">
              <label for="product-name" class="form-label">Product Name</label>
              <input type="text" name="product_name" id="product-name" class="form-control" value="<?= $product['product_name'] ?>"  required autofocus>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
        </div>

        <div class="mb-4">
          <label for="quantity" class="form-label">Quantity</label>
          <input type="number" name="quantity" id="quantity" class="form-control" value="<?= $product['quantity'] ?>" required>
        </div>

        <div class="text-end">
          <a href="dashboard.php" class="btn btn-secondary btn-sm">Cancel</a>
          <button type="submit" class="btn btn-warning btn-sm px-5">Save</button>
        </div>
      </form>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>