<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Cart - AlhurWear</title>
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/a2e0e9e3b0.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- ===== Header ===== -->
  <header class="header">
    <section class="flex">
      <a href="index.php" class="logo">
        <img src="images/pizza logo.jpg" alt="AlhurWear Logo" class="logo-img" />
        <span class="logo-text">AlhurWear</span>
      </a>

      <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php" class="active">Cart</a>
        <a href="checkout.php">Checkout</a>
      </nav>

      <div class="icons">
        <div id="user-profile">
          <i class="fas fa-user-circle"></i>
          <span id="username-display"></span>
        </div>
      </div>
    </section>
  </header>

  <!-- ===== Cart Section ===== -->
  <section class="cart-section">
    <h1 class="heading">My Cart</h1>
    <div class="cart-container">
      <div id="cart-items" class="cart-items">
        <!-- Cart items loaded dynamically -->
      </div>

      <div class="cart-summary">
        <h2>Order Summary</h2>
        <div class="summary-line">
          <span>Subtotal:</span>
          <span id="subtotal">₹0</span>
        </div>
        <div class="summary-line">
          <span>Delivery:</span>
          <span id="delivery">₹100</span>
        </div>
        <div class="summary-line total">
          <span>Total:</span>
          <span id="total">₹0</span>
        </div>
        <button id="checkout-btn" class="btn main-btn">Proceed to Checkout</button>

        <button id="clear-cart" class="btn clear-btn">Clear Cart</button>
      </div>
    </div>
  </section>

  <!-- ===== Footer ===== -->
  <section class="footer">
    <div class="credit">© 2025 AlhurWear | All rights reserved.</div>
  </section>

  <script src="js/script.js"></script>
</body>
</html>
