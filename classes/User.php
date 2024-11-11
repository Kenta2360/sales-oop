<?php
require_once "Database.php";

class User extends Database{
  public function store($request){
    $first_name = $request['first_name'];
    $last_name = $request['last_name'];
    $username = $request['username'];
    $password = $request['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`)
            VALUES ('$first_name', '$last_name', '$username', '$password')";

    if($this->conn->query($sql)){
      header('location: ../views');
      exit;
    }else{
      die('Error creating the user: ' . $this->conn->error);
    }
  }

  public function login($request){
    $username = $request['username'];
    $password = $request['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";

    $result = $this->conn->query($sql);

    if($result->num_rows == 1){
      #Check if the password is correct
      $user = $result->fetch_assoc();

      if(password_verify($password, $user['password'])){
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['first_name'] . " " . $user['last_name'];

        header('location: ../views/dashboard.php');
        exit;
      }else{
        die('Password is incorrect ' . $this->conn->error);
      }
    }else{
      die('Username not found' . $this->conn->error);
    }
  }

  public function logout(){
    session_start();
    session_unset();
    session_destroy();

    header('location: ../views/login.php');
    exit;
  }

  public function getAllProducts(){
    $sql = "SELECT * FROM Products";

    if($result = $this->conn->query($sql)){
      return $result;
    }else{
      die('Error retrieving all products: ' . $this->conn->error);
    }
  }

  public function addProduct($product){

    $prod_name = $product['prod_name'];
    $price = $product['price'];
    $quantity = $product['quantity'];

    $sql = "INSERT INTO Products (`product_name`, price, quantity)
                  VALUES ('$prod_name', $price, $quantity)";

    if($this->conn->query($sql)){
      header('location: ../views/dashboard.php');
      exit;
    }else{
      die('Error creating the user: ' . $this->conn->error);
    }
  }

  public function getProduct($id){
    $sql = "SELECT * FROM Products WHERE id = $id";

    if($result = $this->conn->query($sql)){
      return $result->fetch_assoc();
    }else{
      die('Error retrieving the product: ' . $this->conn->error);
    }
  }

  public function update($request){
    $id            = $request['id'];
    $product_name  = $request['product_name'];
    $price         = $request['price'];
    $quantity      = $request['quantity'];

    $sql = "UPDATE Products SET product_name = '$product_name',
                                price = $price,
                                quantity = $quantity
                            WHERE id = $id";

      if($this->conn->query($sql)){
        header('location: ../views/dashboard.php');
        exit;
      }else{
        die('Error uploading the product: ' . $this->conn->error);
      }
    }

  public function delete($id){

    $sql = "DELETE FROM Products WHERE id = $id";

    if($this->conn->query($sql)){
      header('location: ../views/dashboard.php');
    }else{
      die('Error deleting product: ' . $this->conn->error);
    }
  }

  public function pay($request){
    $id            = $request['id'];
    $stocks      = $request['quantity'] - $request['buy_quantity'];

    $sql = "UPDATE Products SET quantity = $stocks
                            WHERE id = $id";

      if($this->conn->query($sql)){
        header('location: ../views/dashboard.php');
        exit;
      }else{
        die('Error uploading the product: ' . $this->conn->error);
      }
    }
}
?>