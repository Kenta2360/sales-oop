<?php

require "../classes/User.php";

$id = $_GET['id'];
$product_obj = new User;
$product = $product_obj->getProduct($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buy Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
      <h1 class="text-center display-3 fw-bold text-success mb-5">
        <i class="fa-solid fa-cash-register me-3"></i>Buy Product
      </h1>

      <div class="row justify-content-center gx-0">
        <div class="col-9">
          <p>Product Name</p>
          <p class="h2 mb-3"><?= $product['product_name'] ?></p>
          
          <div class="row">
            <div class="col-6">
              <p>Price</p>
              <p class="h2 mb-3">$<?= $product['price'] ?></p>
            </div>
            <div class="col-6">
              <p>Stocks Left</p>
              <p class="h2 mb-3"><?= $product['quantity'] ?></p>
            </div>
          </div>
          
          <form action="./pay-product.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="quantity" value="<?= $product['quantity'] ?>">
            <label for="buy-quantity">Buy Quantity</label>
            <input type="number" name="buy_quantity" id="buy-quantity" class="form-control w-50 mx-auto mb-3" max="<?= $product['quantity'] ?>">
            <button type="submit" class="btn btn-success w-100">Pay</button>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>