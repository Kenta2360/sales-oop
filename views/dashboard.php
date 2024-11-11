<?php
session_start();

require "../classes/User.php";

$product_obj = new User;
$all_products = $product_obj->getAllProducts();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
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
        <span class="navbar-text "><?= $_SESSION['full_name'] ?></span>
        <form action="../actions/logout.php" method="post" class="d-flex ms-2">
          <button type="submit" class="text-danger bg-transparent border-0">Log out</button>
        </form>
      </div>
    </div>
  </nav>

  <main class="row justify-content-center gx-0">
    <div class="col-6">
      <div class="row mb-2">
        <div class="col-6">
          <h2 class=" text-uppercase">Product List</h2>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <button type="button" class="btn text-info fs-1" data-bs-toggle="modal" data-bs-target="#addProduct">+</button>

          <div class="modal fade" id="addProduct" tabindex="1" aria-labelledby="addProductlabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="addProductlabel">Add Product</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="../actions/addProduct.php" method="post">
                    <label for="prod-name" class="form-label">Product Name</label>
                    <input type="text" name="prod_name" id="prod-name" class="form-control">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control mb-3">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <table class="table align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th><!-- for action buttons --></th>
            <th><!-- for action buttons --></th>
          </tr>
        </thead>

        <tbody>
          <?php
            while($product = $all_products->fetch_assoc()){
          ?>
          <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['product_name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['quantity'] ?></td>
            <td>
              <a href="edit-product.php?id=<?= $product['id'] ?>" class="btn btn-warning" title="Edit">
                <i class="fa-regular fa-pen-to-square"></i>
              </a>
              <a href="delete-product.php?id=<?= $product['id'] ?>" class="btn btn-danger" title="Delete">
                <i class="fa-regular fa-trash-can"></i>
              </a>
            </td>
            <td>
              <?php
                if($product['quantity'] > 0){
              ?>
                <a href="buy-product.php?id=<?= $product['id'] ?>" class="btn btn-success" title="Edit">
                  <i class="fa-solid fa-cash-register"></i>
                </a>
              <?php
              }
              ?>
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>